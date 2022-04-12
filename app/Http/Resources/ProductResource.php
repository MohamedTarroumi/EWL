<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BrandResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'description' => $this->description,
            'prix' => $this->prix,
            'files' =>$this->files,
            'created_by' => $this->createdBy,
            'update_by' =>$this->updateBy,
            'model_id' => $this->model,
            'brand_id' =>$this->brand,
            'category_id' => $this->category,  
        ];
    }
}
