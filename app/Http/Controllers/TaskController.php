<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()

    {
        $tasks=Task::orderBy('id','desc')->paginate(16);
        return view('tasks.index')->withTasks($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'=>'required|max:200',
            'upload_image'=>'required|image'
        ));
        $tasks = new Task;
        $tasks->title =$request->title;
        if($request->hasFile('upload_image'))
            $image= $request->file('upload_image');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/'. $filename);
            Image::make($image)->resize(1000,600)->save($location);
            $tasks->images= $filename;

        $tasks->save();
        Session::flash('success','Your image uploaded successfully.');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task=Task::find($id);
        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, array(
            'title'=>'required|max:200',
            'upload_image'=>'required|image'
        ));

        $task=Task::find($id);

            $task->title =$request->input('title');
            if($request->hasFile('upload_image'))
            {
                //add new one
                $image= $request->file('upload_image');
                $filename=time().'.'.$image->getClientOriginalExtension();
                $location=public_path('images/'. $filename);
                Image::make($image)->resize(1000,600)->save($location);
                $oldFile= $task->images;
                //save on database
                $task->images= $filename;
                //delete old one
                Storage::delete($oldFile);
            }

            $task->save();

        Session::flash('success','Your image has been updated successfully.');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::find($id);
        Storage::delete($task->images);
        $task->delete();
        Session::flash('success','Your image has been deleted successfully');
        return redirect()->route('tasks.index');
    }
}
