<?php
namespace Controllers;

use models\TempDao;
use controllers\BaseController as BaseControllers;

class TempController extends BaseControllers
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * 原生查询
     */
    public function lists()
    {
        $model = new TempDao();
        $navigation = $model->select('meiyou_admin', '*', []);
        $this->assign('navigation',$navigation);
        $this->display('temp/lists');

    }
    public function view($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/views');
        $twig = new \Twig\Environment($loader);
        $model = new TempDao();
        $data = $model->getList();
        echo $twig->render('temp/lists.html', ['navigation' => $data]);
    }
}