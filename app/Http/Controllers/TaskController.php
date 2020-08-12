<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;
use App\Http\Validation\AuthValidation;
use App\Http\Validation\TaskValidation;
use App\Models\Task;

class TaskController extends Controller
{
    private const SUCCESS_CREATE_MESSAGE = 'Task successfully added';

    private $taskModel;

    private $taskValidation;

    const PAGINATION_LIMIT = 3;

    public function __construct()
    {
        parent::__construct();

        $this->baseTemplate = 'layouts/app';

        $this->taskModel = new Task();

        $this->taskValidation = new TaskValidation();
    }

    public function edit(Request $request)
    {
        $this->allowOnlyAuth($request);

        $id = (int)$request->explodeParams()[3];

        $task = $this->taskModel->findById($id);

        $this->view('task/edit', [
            'task' => $task
        ]);
    }

    public function update(Request $request)
    {
        $this->allowOnlyAuth($request);

        $this->taskValidation->check($request);
        $id = (int)$request->get('id');

        $this->taskModel->updateTask($id, [
            'author' => $request->get('username'),
            'mail' => $request->get('mail'),
            'text' => $request->get('text'),
            'completed' => $request->get('completed') === '',
        ]);

        $this->redirect('/task/edit/'.$id);
    }


    public function index(Request $request)
    {
        $page = (int)$request->get('page');
        $page = $page ? $page : 1;

        $pagination = $this->taskModel->paginationDetails(self::PAGINATION_LIMIT, $page);
        $tasks = $this->taskModel->paginate(
            self::PAGINATION_LIMIT,
            $page,
            $request->get('field') ?  $request->get('field') : 'author',
            $request->get('by')
        );

        $this->view('task/index', [
            'tasks' => $tasks,
            'pagination' => $pagination,
        ]);
    }

    public function store(Request $request)
    {
        $this->taskValidation->check($request);

        $this->taskModel->create($request->get('username'), $request->get('mail'), $request->get('text'));

        $this->redirect('?successAlert=' . self::SUCCESS_CREATE_MESSAGE);
    }
}