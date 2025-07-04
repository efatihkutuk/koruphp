<?php
namespace Apps\Demo\Controller;

use Apps\Demo\Repository\UserRepository;
use KoruPHP\View\View;

class UserController
{
    public function __construct(private UserRepository $repo, private View $view)
    {
    }

    public function list(): string
    {
        $users = $this->repo->findAll();
        return $this->view->render('users_list.php', ['users' => $users, 'session' => $_SESSION]);
    }

    public function createForm(): string
    {
        return $this->view->render('user_form.php', ['user' => null, 'action' => '/users/create', 'session' => $_SESSION]);
    }

    public function create(): string
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if ($username && $password) {
            $this->repo->create($username, $password);
        }
        header('Location: /users');
        return '';
    }

    public function editForm(): string
    {
        $id = (int)($_GET['id'] ?? 0);
        $user = $this->repo->findById($id);
        if (!$user) { http_response_code(404); return 'User not found'; }
        return $this->view->render('user_form.php', ['user' => $user, 'action' => '/users/edit', 'session' => $_SESSION]);
    }

    public function edit(): string
    {
        $id = (int)($_POST['id'] ?? 0);
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if ($id && $username) {
            $this->repo->update($id, $username, $password);
        }
        header('Location: /users');
        return '';
    }

    public function delete(): string
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id) {
            $this->repo->delete($id);
        }
        header('Location: /users');
        return '';
    }
}
