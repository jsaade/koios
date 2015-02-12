<?php namespace Acme\Observers;
use Input;
use News;

class NewsObserver  
{
	
	public function created($news)
	{
		$input = Input::all();
		$uploaded_image = Input::file('image');
		$filename = $news->uploadImage($uploaded_image);
		$news->update(['image' => $filename]);
	}	

	/**
	 * Upload/Remove image upon create/update news
	 * @param News the news model being saved
	 */
	public function saving($model)
    {
		$input = Input::all();
		$uploaded_image = Input::file('image');
	
		//edit case
		if($model->id)
		{
			$news = News::find($model->id);
			//remove old picture
			if(isset($input['remove_image']))
			{
				$news->removeImage();
				$model->image = '';
			}
			//update new picture
			if($uploaded_image)
			{
				$filename = $news->uploadImage($uploaded_image);
				$model->image = $filename;
			}
		}
    }


    /**
	 * remove image after deleting a news
	 * @param News the news model being saved
	 */
    public function deleted($news)
    {
		$news->removeImage();
    }
}