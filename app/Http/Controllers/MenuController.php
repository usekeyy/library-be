<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $menuChild = json_decode(json_encode(Menu::ByUser($user_id)->distinct()->get()), true);
        $parent_id = array_column($menuChild, 'parent_id');
        $menuParent = json_decode(json_encode(Menu::parentNoPermission($parent_id)->get()), true);
        $menus = array_merge($menuChild, $menuParent);
        $keys = array_column($menus, 'order_no');
        array_multisort($keys, SORT_ASC, $menus);

        $model = $this->buildTree($menus);
        $response = responseSuccess(__('messages.read-success'), $model);
        return response()->json($response, 200);
    }

    private function buildTree_new(array $menus, $parentId = 0)
    {
        $branch = array();

        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId && !is_null($menu['parent_id'])) {
                $children = $this->buildTree_new($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $branch[] = $menu;
            }
        }

        return $branch;
    }
}
