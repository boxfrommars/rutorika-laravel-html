<?php
namespace Rutorika\Html\Http;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    use ValidatesRequests;

    public function upload(Request $request)
    {
        $this->validateUpload($request);

        $file = $request->file('file');
        $file = $this->processUpload($file, $request->get('type'));

        $filename = static::generateFilename($file);
        $fileDestinationInfo = static::getDestinationInfo($filename, config('rutorika-form.public_storage_path'));

        $file->move($fileDestinationInfo['destination'] . DIRECTORY_SEPARATOR, $fileDestinationInfo['filename']);

        return \Response::json(['path' => $fileDestinationInfo['public_destination'], 'filename' => $fileDestinationInfo['assets_destination']]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile|array $file
     *
     * @return string
     */
    public static function generateFilename($file)
    {
        $filename = md5(uniqid() . '_' . $file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        $filename = $extension ? $filename . '.' . $extension : $filename;

        return $filename;
    }

    public static function getDestinationInfo($filename, $path)
    {
        $splittedFilename = str_split($filename, 2); // 'abcdrefgh...' => ['ab', 'cd', 'ef', 'gh',..]
        $subpath = implode(DIRECTORY_SEPARATOR, array_slice($splittedFilename, 0, 2)); // implode('/', ['ab', 'cd']) = 'ab/cd' -- subpath
        $filename = implode('', array_slice($splittedFilename, 2));  // implode('', ['ef', 'gh']) = 'efgh' -- filename

        return [
            'destination' => implode(DIRECTORY_SEPARATOR, [public_path(), $path, $subpath]),
            'filename' => $filename,
            'public_destination' => implode(DIRECTORY_SEPARATOR, ['', $path, $subpath, $filename]),
            'assets_destination' => implode(DIRECTORY_SEPARATOR, [$subpath, $filename]),
        ];
    }

    /**
     * @param Request $request
     */
    protected function validateUpload($request)
    {
        $typesConfig = config('rutorika-form.upload.types', []);
        $typeConfig = array_get($typesConfig, $request->get('type', 'default'));

        $this->validate($request, [
            'type' => 'required|in:' . implode(',', array_keys($typesConfig)),
            'file' => array_get($typeConfig, 'rules', 'image|max:3072'),
        ]);
    }

    /**
     * Override this in the child class to process file (crop image, add watermarks etc.). Also you can use `type` to choose what manipulation do
     *
     * @param $file
     * @param $type
     *
     * @return mixed
     */
    protected function processUpload($file, $type)
    {
//        switch ($type) {
//            case 'album-image':
//                $file = SomeImageLibrary::addWatermark($file)
//                break;
//            case 'cat-photo':
//                $file = SomeImageLibrary::resizeAndAddMimi($file)
//                break;
//        }
        return $file;
    }
}