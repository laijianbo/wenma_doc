<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;

class FileController extends Controller
{
    /**
     * 上传图片文件
     *
     * @param Request $request
     *
     * @return array
     */
    public function imageUpload(Request $request)
    {
        $file = $request->file('editormd-image-file');
        if(!$file->isValid()) {
            return $this->response(false, __('common.upload.failed', ['reason' => $file->getErrorMessage()]));
        }

        if(!in_array(strtolower($file->extension()), ["jpg", "jpeg", "gif", "png", "bmp"])) {
            return $this->response(false, __('common.upload.invalid_type'));
        }
        // 使用七牛云存储图片
        $disk = QiniuStorage::disk('qiniu');
        $filename = 'doc/image_' . md5($file->getFilename()) . "." . $file->getClientOriginalExtension();
        $disk->put($filename, file_get_contents($file->getRealPath()));
        return $this->response(true, __('common.upload.success'), $disk->downloadUrl($filename));
        //        $path = $file->storePublicly(sprintf('public/%s', date('Y/m-d')));
        //
        //        return $this->response(true, __('common.upload.success'), \Storage::url($path));
    }

    private function response(bool $isSuccess, string $message, $url = null)
    {
        return [
            'success' => $isSuccess ? 1 : 0,
            'message' => $message,
            'url'     => $url,
        ];
    }

}
