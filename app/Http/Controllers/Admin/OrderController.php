<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderGoods;
use Yajra\Datatables\Facades\Datatables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.order.list');
    }

    public function dtData()
    {
//        dd(request()->all());
        $where = [];
        if(\request('is_pay') !== null){
            $where[] = ['is_pay', \request('is_pay')];
        }
        if(\request('status') !== null){
            $where[] = ['status', \request('status')];
        }
        if(\request('floor_name') !== null){
            $where[] = ['floor_name', \request('floor_name')];
        }

        $query = Order::select('orders.*', 'goods.id', 'goods.name', 'goods.category_id',
            'order_goods.goods_attribute_ids', 'order_goods.shop_price', 'order_goods.shop_number', 'order_goods.status', 'order_goods.id as order_goods_id')
            ->join('order_goods', 'order_goods.order_id', '=', 'orders.id')
            ->join('goods', 'order_goods.goods_id', '=', 'goods.id')
            ->where($where);

        return Datatables::of($query)
            ->addColumn('self_info', function (Order $order){
            //通过admin,处理出一段希望展示出来的roles字段,以行为单位
                return "$order->name<br/>$order->phone<br>$order->garden_name $order->floor_name $order->number";
            })
            ->addColumn('order_content', function (Order $order){
                return $order->orderContent();
            })->rawColumns(['self_info','order_content'])
           /* ->addColumn('action', 'admin.order.dt_buttons')*/
            ->make(true);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function handleOrder(){
        $order_goods_ids = request('order_goods_ids');
        $status = request('status');
        $res = OrderGoods::whereIn('id', $order_goods_ids)->update([
            'status' => $status
        ]);
        return $res; //受影响的记录数
    }
}
