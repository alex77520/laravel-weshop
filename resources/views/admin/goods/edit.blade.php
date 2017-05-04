@extends('admin.layouts.layout')
@section('css')
    {{--日期选择控件--}}
    <script src="/plugins/laydate-v1.1/laydate/laydate.js"></script>
<style>

</style>
@stop
@section('content')
<section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">修改商品</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="POST" action="/admin/goods/{{ $goods->id }}"  enctype="multipart/form-data" >
                    {{ csrf_field() }}
                        {{ method_field('put') }}
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">基本信息</a></li>
                            <li><a href="#tab_2" data-toggle="tab">商品描述</a></li>
                            <li><a href="#tab_3" data-toggle="tab">商品属性</a></li>
                        </ul>
                        <div class="tab-content">

                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        <label for="category_id" class="col-md-4 control-label">商品分类 *</label>
                                        <div class="col-md-4">
                                            <select name="category_id" class="form-control select2" data-placeholder="请选择" style="width: 100%;">
                                                <option value="">请选择</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id==old('category_id', $goods->category_id)?'selected':'' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">商品名称 *</label>

                                        <div class="col-md-4">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $goods->name) }}" placeholder="30字限制,可在此填写一些商品的必要信息">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label for="price" class="col-md-4 control-label">商品价格 *</label>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input name="price" type="text" class="form-control" id="price" value="{{ old('price', $goods->price) }}" placeholder="精确到0.01">
                                                <div class="input-group-addon">元</div>
                                            </div>
                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('promote_price') ? ' has-error' : '' }}">
                                        <label for="promote_price" class="col-md-4 control-label">促销价格</label>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input name="promote_price" type="text" class="form-control" id="" value="{{ old('promote_price', $goods->promote_price) }}" placeholder="精确到0.01">
                                                <div class="input-group-addon">元</div>
                                            </div>
                                            @if ($errors->has('promote_price'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('promote_price') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('promote_start_at') || $errors->has('promote_stop_at') ? ' has-error' : '' }}">
                                        <label for="promote_start_at" class="col-md-4 control-label">促销时间</label>
                                        <div class="col-md-2">
                                            <input name="promote_start_at" class="form-control" id="promote_start_at" value="{{ old('promote_start_at', $goods->promote_start_at) }}" placeholder="促销开始时间">
                                            @if ($errors->has('promote_start_at'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('promote_start_at') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <input name="promote_stop_at" class="form-control" id="promote_stop_at" value="{{ old('promote_stop_at', $goods->promote_stop_at) }}"  placeholder="促销结束时间">
                                            @if ($errors->has('promote_stop_at'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('promote_stop_at') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                        <label for="sort" class="col-md-4 control-label">权重(从小到大)</label>

                                        <div class="col-md-4">
                                            <input name="sort" type="number" class="form-control" value="{{ old('sort', $goods->sort) }}" id="" placeholder="数字越大,商品展示越靠前">
                                            @if ($errors->has('sort'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('sort') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('is_on_sale') ? ' has-error' : '' }}">
                                        <label for="is_on_sale" class="col-md-4 control-label">是否上架</label>

                                        <div class="col-md-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_on_sale" value="1" {{ old('is_on_sale', $goods->is_on_sale) == 1?'checked':'' }}> 是
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_on_sale"  value="0" {{ old('is_on_sale', $goods->is_on_sale) == 0?'checked':'' }}> 否
                                            </label>
                                            @if ($errors->has('is_on_sale'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('is_on_sale') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('is_best') ? ' has-error' : '' }}">
                                        <label for="is_best" class="col-md-4 control-label">是否精品</label>

                                        <div class="col-md-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_best"  value="1"  {{ old('is_best', $goods->is_best) == 1?'checked':'' }}> 是
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_best"  value="0"  {{ old('is_best', $goods->is_best) == 0?'checked':'' }}> 否
                                            </label>
                                            @if ($errors->has('is_best'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('is_best') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                        <label for="sort" class="col-md-4 control-label">商品图片预览</label>

                                        <div class="col-md-4">
                                            <img src="{{ $goods->mid_image }}" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label for="image" class="col-md-4 control-label"></label>
                                        <div class="col-md-4">
                                            <div class="control-label"><input type="file" name="image" value="" class=""></div>
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @else
                                                <span class="help-block">
                                                    <strong>若不更换图片请勿选择文件</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{--<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label for="image" class="col-md-4 control-label">商品图片 *</label>
                                        <div class="col-md-4">
                                            <div class="control-label">
                                                <input type="file" name="image" value="">
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @else
                                                <b>若不更换图片,请勿选择任何文件!</b>
                                            @endif
                                        </div>
                                    </div>--}}
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <!-- 编辑器容器 -->
                                        <div class="col-md-12">
                                            <div id="description" name="description" type="text/plain"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group">
                                        <label for="" class="control-label col-md-4">商品类型</label>
                                        <div class="col-md-4">
                                            <select name="type_id"  class="form-control" data-placeholder="请选择"
                                                    @change="changeType()" v-model="selected" placeolder="请选择"
                                            >
                                                <option value="">请选择</option>
                                                <option v-for="type in types"
                                                        :value="type.id">@{{ type.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <span>请检查并避免属性值的重复,置空或者不做选择则不被录入</span>
                                        </div>
                                    </div>
                                    {{--属性区域--}}
                                    <div class="form-group" v-for="(attribute,index) in attributes">
                                        {{--绑定一个goods_attribute_id,这条id只有原先的商品属性存在--}}
                                        <label for="" class="control-label col-md-4">@{{ attribute.name }}</label>
                                        <input type="hidden" name="goods_attribute_ids[]" :value="attribute.goods_attribute_id">
                                        <div class="col-md-4">
                                            <template v-if="attribute.type == '唯一'"> {{--//只有来自服务器的数据才需要绑定属性值, 因为attribute.attribute_value的值被绑定了--}}
                                                <input type="text" :name="'attribute_values['+attribute.id+'][]'"  v-model="attribute.attribute_value" class="form-control" v-if="attribute.option_values == '' || attribute.option_values == null">
                                                <select :name="'attribute_values['+attribute.id+'][]'"
                                                        v-model="attribute.attribute_value"
                                                        class="form-control select2" placeholder="请选择" v-else>
                                                    <option :value="null">请选择</option>
                                                    <option :value="option_value"
                                                            v-for="option_value in attribute.option_values"
                                                    >@{{ option_value }}</option>
                                                </select>
                                            </template>
                                            <template v-else>
                                                <div class="input-group"  v-if="attribute.option_values == '' || attribute.option_values == null">
                                                    <input type="text" :name="'attribute_values['+attribute.id+'][]'"  v-model="attribute.attribute_value" class="form-control">
                                                    <div class="input-group-addon">
                                                        <a  @click.prevent="switchSelf(index, attribute)"> {{--有可能是减少自己也有可能是增加自己--}}
                                                            <i class="fa" :class="[attribute.is_first_attr?'fa-plus':'fa-minus']"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="input-group"  v-else>
                                                    <select :name="'attribute_values['+attribute.id+'][]'"
                                                            v-model="attribute.attribute_value"
                                                            class="form-control select2" data-placeholder="请选择">
                                                        <option :value="null">请选择</option>
                                                        <option :value="option_value"
                                                                v-for="option_value in attribute.option_values"
                                                        >@{{ option_value }}</option>
                                                    </select>
                                                    <div class="input-group-addon">
                                                        <a @click.prevent="switchSelf(index, attribute)"> {{--有可能是减少自己也有可能是增加自己--}}
                                                            <i class="fa" :class="[attribute.is_first_attr?'fa-plus':'fa-minus']"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                    <div class="col-md-2 col-md-offset-4">
                        <a href="{{ url('/admin/goods') }}" class="btn btn-block btn-default btn-flat">返回</a>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-block btn-primary btn-flat">提交</button>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
@stop
{{--引入ue编辑器--}}
@include('vendor.ueditor.assets')
@section('js')
<script>
    //vue测试
    new Vue({
        el : '#app',
        data : {
            selected : {!! $goods->type_id?$goods->type_id:"''" !!} ,
            types : [],
            attributes : [],
        },
        created(){
            this.getEditAttr();
            this.getTypes();
        },
        methods :　{
            switchSelf(index, attribute){
                //分情况 如果属性是第一个的话,则直接添加新的
                if(attribute.is_first_attr){ //未定义的数据类型,则肯定是服务器数据,只能+
                    let newAttribute = {
                        'id' : attribute.id,
                        'name' : attribute.name,
                        'option_values' : attribute.option_values,
                        'type' : attribute.type,
                        'type_id' : attribute.type_id,
                        'is_first_attr' : false,
                        'attribute_value' : '',
                    };
                    //往数组中的该index的后面插入一条数据
                    this.attributes.splice(index+1, 0, newAttribute);
                } else {
                    //如果属性已经出现过则减少, 根据是否存在goods_attr_id再进行判断
                    if(attribute.goods_attribute_id) {
                        swal({
                                title: "是否删除该属性?",
                                text: "该属性已经存入到数据库中,删除该属性的同时,将会删除其对应的库存量!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "确定",
                                cancelButtonText: "取消",
                                closeOnConfirm: true
                            },
                            () => {
                                this.attributes.splice(index, 1);
                               //点击确定之后的回调
                                axios.delete('/admin/goods_attributes/'+attribute.goods_attribute_id, {

                                })
                                /*.then((response)=> {
                                    this.attributes =  response.data;
                                })
                                .catch(error=> {
                                    swal("属性删除失败!", "warning")
                                });*/

                            });
                    }else{
                        //不存在goods_attribute_id直接删除即可
                        this.attributes.splice(index, 1);
                    }
                }
            },
            /**
             * 商品类型的ajax数据
             */
            getTypes(){
                axios.get('/admin/types/ajax_types', {
                    params: {
                        //这里的数据将会以  ?key=value的形式出现
                    }
                })
                    .then((response)=> {
                        this.types = response.data;
                    })
                    .catch(error=> {
                        if(error.response.status == 404){
                            alert('资源不存在'+error.response.data.message);
                        }
                    });
            },
            /**
             * 商品分类的ajax数据
             */
            getEditAttr(){
                if(this.selected){
                    axios.get('/admin/types/{{ $goods->type_id }}/attributes/ajax_edit_attr', {
                        params: {
                            'goods_id' : {{ $goods->id }},
                        }
                    })
                    .then((response)=> {
                        this.attributes =  response.data;
                    })
                    .catch(error=> {
                        this.attributes = [];
                    });
                }
            },

            getAttributes(){
                if(this.selected == ""){
                    this.attributes = [];
                    return;
                }
                axios.get('/admin/types/'+this.selected+'/attributes/ajax_attributes', {
                    params: {
                        //这里的数据将会以  ?key=value的形式出现
                    }
                })
                .then((response)=> {
                    this.attributes =  response.data;
                })
                .catch(error=> {
                    if(error.response.status == 404){
                        alert('资源不存在'+error.response.data.message);
                    }
                });
            },
            changeType(){
                this.getAttributes()
            }
        }
    });
    //ue浏览器
    var ue = UE.getEditor('description', {  //UE应该是UE的全局变量,类似于VUE,$等
        initialFrameWidth:"100%",
        initialFrameHeight:"500",
//        zIndex: 3000
    });
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        ue.setContent('{!! old('description', $goods->description) !!}');
    });
    //select2
    $(".select2").select2({

    });
    laydate.skin('molv');
    let start = {
        elem: '#promote_start_at',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: laydate.now(), //设定最小日期为当前日期
        istime: true,
        choose: function(datas){
            end.start = datas //将结束日的初始值设定为开始日
        }
    }

    let end = {
        elem: '#promote_stop_at',
        format: 'YYYY-MM-DD hh:mm:ss',
        istime: true,
    }
    laydate(start);
    laydate(end);
</script>
@stop