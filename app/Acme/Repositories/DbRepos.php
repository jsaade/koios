<?php 
namespace Acme\Repositories;

class DbRepos
{

	public function getApiPagerLinks($collection, $routeName, $routeParams)
	{
		$currentPage = $collection->getCurrentPage();
		$nextPage  = $currentPage + 1;
		$prevPage  = $currentPage - 1;
		$lastPage = $collection->getLastPage();
		$limit = $collection->getPerPage(); 

		$arr = [ 'total' => $collection->getTotal()];

		if($nextPage < $lastPage)
			$arr['next'] = route($routeName, $routeParams)."?limit={$limit}&page={$nextPage}";
		
		if($prevPage >= 1)
			$arr['prev'] = route($routeName, $routeParams)."?limit={$limit}&page={$prevPage}";

		return $arr;
	}
}

?>