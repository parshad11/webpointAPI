<?php
namespace App\Repositories;

use App\Models\WebPointContact;
use App\Repositories\ContractRepository\ContractRepositoryInterface;

class ContractRepository implements ContractRepositoryInterface{

    public function addContract($request){
        $EventAdd = WebPointContact::create($request);
        return $EventAdd->makeHidden(['deleted_at', 'created_at', 'updated_at']);
    }

    public function getContract($searchQuery = ''){
        $query = WebPointContact::query()->select('id','full_name','email','phone')->orderBy('id', 'ASC');
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('full_name', 'LIKE', '%'.$searchQuery.'%');
            });
        }
        return $query->paginate();
    }
    public function editContract( $request){
        return WebPointContact::where('id',$request['id'])->update($request);
    }
    public function deleteContract( $request){
        $deletingEvent = WebPointContact::find($request['id']);
        return $deletingEvent->delete();;
    }

}