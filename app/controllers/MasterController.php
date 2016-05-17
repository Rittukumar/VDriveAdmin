<?php 


class MasterController extends AppController
{


	public function getAllCategories()
	{

		try{

			$categories = Category::all();

			return $categories;

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}


	public function getsubCategoryById($categoryId)
	{

		try{

			$subcategories = SubCategory::where('category_id', '=', $categoryId)->get();

			return $subcategories;

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);
		}

	}


	public function deleteCategory($categoryId)
	{

		try{

			$delete = Category::where('id', $categoryId)->delete();

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}


	public function deleteSubCategory($subcategoryId)
	{

		try{

			$delete = SubCategory::where('id', $subcategoryId)->delete();

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}






}


?>