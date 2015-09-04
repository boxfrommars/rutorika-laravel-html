<?php
namespace Rutorika\Html\Http;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Class Select2ableTrait
 */
trait Select2ableTrait
{
    protected $select2titleKey = 'title';

    protected function select2query()
    {
        /** @var Builder $query */
        $query = $this->getQuery();

        return $query->select('id', $this->select2titleKey . ' as text');
    }

    protected function wrapResult($data)
    {
        return ['results' => $data];
    }

    public function select2search(Request $request)
    {
        $searchTerm = $request->get('q');

        $query = $this->select2query();
        if ($searchTerm) {
            $query->where($this->select2titleKey, 'LIKE', "%" . $searchTerm . "%");
        }

        return $this->wrapResult($query->get());
    }

    public function select2searchInit(Request $request)
    {
        $ids = (array) $request->get('ids');
        $query = $this->select2query()->whereIn('id', $ids);

        return $this->wrapResult($query->get());
    }
}