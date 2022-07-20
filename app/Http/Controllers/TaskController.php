<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{


    /**
     * タスクリポジトリ
     * @var TaskRepository
     */
    protected $tasks;


    
    /**
     * コンストラクタ
     * 
     * @return void
     */

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    
    
    
    /**
     * extends Controller：Controllerが親
     * class TaskController：TaskControllerという操作ができるクラス
     * タスク一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$tasks = Task::orderBy('created_at', 'asc')->get();'requi
        //Task Modelからデータを取り出す
        // dd($tasks);
        // $tasks = $request->user()->tasks()->get();
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
            // 取り出したデータをviewのtasksのindexで表示する
            // indexと書けばtasksのindex.blade.phpという意味になる
            // $tasksをviewのviewのtasksのindexで表示したいときのルール
            // Controllerのreturnの後で①$tasksの$を外して''で囲みと（'tasks' => $tasks）,
            // ②viewで''の中身に$をつけて表す
            // こうすることでControllerの$tasksをviewで表示できる
        ]);

    }
    /**
         * タスク登録
         * 
         * @param Request $request
         * @return Response
         */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスク作成
        // Task::create([
        //     'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
        // redirect URLに飛ぶ
        // 127.0.0.1:8000/tasksで検索したとき(COntrollerのindexに飛ぶ)
    }
    
    /**
     * タスク削除
     * 
     * @param Request $request
     * @param Task $task
     * @return Response
     */

    public function destroy(Request $request, Task $task)
    {

        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');
        // redirect URLに飛ぶ
        // redirect 127.0.0.1:8000/tasksで検索したとき(COntrollerのindexに飛ぶ)
    }



}
