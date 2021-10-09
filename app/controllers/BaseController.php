<?php
namespace controllers;


class BaseController
{
    protected $twig;
    protected $data = array();
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/views');
        $this->twig = new \Twig\Environment($loader,[]);
    }

    /**
     * @param $var
     * @param null $value
     */
    public function assign($var,$value=null){
        if (is_array($var)){
            $this->data = array_merge($this->data,$var);
        }else{
            $this->data[$var] = $value;
        }
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function display($template){
        echo $this->twig->render($template.'.html', $this->data);
    }
    public function success($url,$mess){
        echo "<script>";
        echo "alert('{$mess}')";
        echo "location.href='{$url}'";
        echo "</script>";
    }
    public function error($url,$mess){
        echo "<script>";
        echo "alert('error:{$mess}')";
        echo "location.href='{$url}'";
        echo "</script>";
    }
}