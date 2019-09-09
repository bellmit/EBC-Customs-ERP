<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 11:17
 */

namespace LAuth\Http\Controllers\Authorities;


use LAuth\Http\Controllers\Controller;
use LAuth\Http\Requests\Api\Authorities\RoleRequest;
use LAuth\Http\Searchs\Api\Authorities\RoleSearch;
use LAuth\Repositories\Menu;
use LAuth\Repositories\Role;

class RoleController extends Controller
{
    /**
     * @var Role
     */
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @param RoleSearch $search
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 15:46
     */
    public function index(RoleSearch $search)
    {
        return $this->response(
            $this->role->paginate($search->toArray())
        );
    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:33
     */
    public function create(Menu $menu)
    {
        return $this->response(
            $menu->get(['id', 'name as title', 'parent_id'])
        );
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:33
     */
    public function store(RoleRequest $request)
    {
        return $this->response(
            $this->role->create(
                $request->only([
                    'name', 'description', 'authorities', 'menus'
                ])
            )
        );
    }

    /**
     * @param Menu $menu
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 17:09
     */
    public function edit(Menu $menu, $id)
    {
        return $this->response(
            [
                'menus' => $menu->get(['id', 'name as title', 'parent_id']),
                'row' => $this->role->findEdit($id)
            ]
        );
    }

    /**
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 17:13
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(RoleRequest $request, $id)
    {
        return $this->response(
            $this->role->update($id, $request->only([
                'name', 'description', 'authorities', 'menus'
            ]))
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:21
     * @throws \Exception
     */
    public function destroy($id)
    {
        return $this->response(
            $this->role->delete($id)
        );
    }
}