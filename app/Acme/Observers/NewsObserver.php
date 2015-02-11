<?php namespace Acme\Observers;
use Input;
use News;

class NewsObserver  
{
	
	/**
	 * upload/remove image upon create/update news
	 * @param News the news model being saved
	 */
	public function saving($model)
    {
		$input = Input::all();
		$uploaded_image = Input::file('image');
		$news = News::find($model->id);

		if(isset($input['remove_image']))
		{
			$news->removeImage();
			$model->image = '';
		}

		if($uploaded_image)
		{
			$filename = $news->uploadImage($uploaded_image);
			$model->image = $filename;
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