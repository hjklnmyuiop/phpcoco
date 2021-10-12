<?php
namespace Controllers;


use Intervention\Image\ImageManagerStatic as Image;
use models\TempDao;
use controllers\BaseController as BaseControllers;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

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
    public function fileupload(){
        $path = dirname(__DIR__).'\uploader';
        $storage = new FileSystem($path);
        $file = new File('foo', $storage);
        // Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName($new_filename);

        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
            // Ensure file is of type "image/png"
            new Mimetype(array('image/png', 'image/gif','image/jpg','image/jpeg')),
            //You can also add multi mimetype validation
            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))
            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new Size('50M')
        ));
        // Access data about the file that has been uploaded
        $data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        );
        // Try to upload file
            $file_name =$path.'/'.$new_filename.'.'.$data['extension'];
        try {
            // Success!
            $file->upload();
            //添加水印裁剪
//            // open an image file
            $img = Image::make($file_name);
//            // resize image instance
            $img->resize(320, 240);
//            // insert a watermark
            $img->insert($path.'/watermark.gif');
//            // save image in desired format
            $img->save($path.'/'.$new_filename.'_1.'.$data['extension']);
        } catch (\Exception $e) {
            // Fail!
            $errors = $file->getErrors();
            dd($errors);
        }
    }
    public function watermark(){
        $new_filename = '6164ffef2bfb0';
        $path = dirname(__DIR__).'\uploader';
        $data['extension'] = 'jpg';
        $file_name =$path.'/'.$new_filename.'.jpg';

        $img = Image::make($file_name);
//            // resize image instance
        $img->resize(320, 240);
//            // insert a watermark
        $img->insert($path.'/watermark.gif');
//            // save image in desired format
        $img->save($path.'/'.$new_filename.'_1.'.$data['extension']);
    }
}