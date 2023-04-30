<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ContractTraits\ContractEncriptionTrait;

class SuccessResource extends JsonResource
{
    use ContractEncriptionTrait;
    
    private $data;
    public function __construct($data) {
        $this->encryptKeys($data);
        $this->data = $data;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                'status' => 'success',
            ]+$this->data;
    }
}
