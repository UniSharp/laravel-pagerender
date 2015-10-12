<?php
namespace Unisharp\Pagerender;

trait PageRenderTrait
{
    /*********************************
     *********    General    *********
     ********************************/

    public function render()
    {
        if (!empty($page->custom_view)) {
            return view($this->folder.'.'.$page->custom_view);
        } else {
            return view($this->folder.'.'.$this->default_view);
        }
    }

    public function subs()
    {
        return $this->hasMany(get_class(), 'parent_id', 'id');
    }

    public function hasSubs()
    {
        return $this->subs->count > 0;
    }

    public function parent()
    {
        return $this->hasOne(get_class(), 'id', 'parent_id');
    }

    public function hasParent()
    {
        if ($this->parent_id === 0 || is_null($this->parent)) {
            return false;
        } else {
            return true;
        }
    }

    public function roots()
    {
        return self::where('parent_id', 0)->get();
    }

    public function isRoot()
    {
        return !self::hasParent();
    }

    /*********************************
     **********    Alias    **********
     ********************************/

    public function getByAlias($alias)
    {
        return self::where('alias', $alias)->first();
    }

    public function hasByAlias($alias)
    {
        return self::where('alias', $alias)->exists();
    }

    public function allWithAlias()
    {
        return self::whereNotNull('alias')->get();
    }

    /********************************
     **********    Tree    **********
     *******************************/

    public function getLevel($page = null)
    {
        if (is_null($page)) {
            $page = $this->find($this->id);
        }

        if ($page->isRoot()) {
            return 0;
        }

        return 1 + self::getLevel($page->parent);
    }

    public function ancestors($page = null, $arr_page = array())
    {
        if (is_null($page)) {
            $page = $this->find($this->id);
        }

        if ($page->isRoot()) {
            array_push($arr_page, $page);
            return $arr_page;
        }

        $arr_page = self::ancestors($page->parent, $arr_page);
        array_push($arr_page, $page);

        return $arr_page;
    }

    public function tree()
    {
        return true;
    }
}
