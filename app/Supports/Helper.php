<?php


namespace App\Supports;

use App\Models\MyFile;
use Illuminate\Support\Facades\DB;
use function Nette\Utils\isEmpty;

trait Helper
{
    public function handleRequest($callback, $task = false, $moduleNameLwr = '')
    {
        if ($task && !$this->can($moduleNameLwr.'_'.$task)){
            return response()->json([
                'status' => 5000,
                'message' => 'You do not have permission to '.$task.' '.$moduleNameLwr
            ]);
        }

        try {
            return $callback();
        } catch (\Exception $exception) {
            return response()->json([
                'data' => $exception->getMessage(),
                'status' => 5000,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function can($permissionName)
    {
//        $permissions = $this->authPermissions();
//        if (in_array($permissionName, $permissions)) {
//            return true;
//        };
        return true;
    }

    public function authPermissions()
    {
        return DB::table('permissions')
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('role_id', auth()->user()->role_id)
            ->get()->pluck('name')->toArray();
    }

    public function getFileId($inputFile, $thumbnail_id)
    {
        if (isset($inputFile['id'])){
            return $inputFile['id'];
        }

        if ($thumbnail_id){

        }

        $file = new MyFile();
        $file->fill($inputFile);
        $file->user_id = auth()->user()->id;
        $file->save();

        return $file->id;
    }
}
