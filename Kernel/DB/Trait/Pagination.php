<?php 
namespace DB;

/**
 * Pagination
 */
trait Pagination {

	protected function EditPaginationLimit($limit) {
		# update limit offset
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

		_envSetter('limit', $limit);
		$offset = $limit * ($page - 1);
		_envSetter('offset', $offset);
	}

	protected function paginate($q) {
		if (isset($_GET['page']) AND $_GET['page'] == 0) {
			$res = current($q->get());
		} else {
			$paginate = $this->pagenumber($q);

			$res = $q->take(_env('limit'))
			->skip(_env('offset'))
			->get()
			->toArray();
			
			$res['paginate'] = $paginate;
		}

		return $res;
	}

	protected function pagenumber($q) {
		if (!is_null($q->groups) OR $q->distinct)
			$total = sizeof(current($q->get()));
		else
			$total = $q->count();

		$currentPage = (isset($_GET['page'])) ? (int) $_GET['page'] : 1 ;
		$lastPage = (int) ceil($total / _env('limit'));
		
		return array(
			'currentPage' => $currentPage,
			'lastPage' => $lastPage,
			'total' => $total
		);
	}
}