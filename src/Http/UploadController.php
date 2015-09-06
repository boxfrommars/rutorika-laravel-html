<?php
namespace Rutorika\Html\Http;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller {

    use ValidatesRequests;

    public function upload(Request $request)
    {
        \Log::debug($request->all());

        $this->validate($request, [
            'file' => 'image'
        ]);

        $file = $request->file('file');

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
}