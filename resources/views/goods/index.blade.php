@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/plugins/swiper/swiper.min.css"/> <!--轮播-->
    <link rel="stylesheet" href="/css/home.css"/> {{--首页css--}}
<style>
</style>
@stop
@section('content')
    <!--**************** 搜索 ********************-->
    <div class="weui-search-bar" id="searchBar">
        <form class="weui-search-bar__form">
            <div class="weui-search-bar__box">
                <i class="weui-icon-search"></i>
                <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
                <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
            </div>
            <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
                <i class="weui-icon-search"></i>
                <span>搜索</span>
            </label>
        </form>
        <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
    </div>
    <!--**************** 轮播 ********************-->
    <div class="swiper-container">
        <div class="swiper-wrapper" style="height:230px;background:#ccc;">
            @foreach($actives as $active)
                <div class="swiper-slide">
                    <a href="{{ $active->is_content?'/actives/'.$active->url:'#' }}">
                        <img src="{{ $active->image }}" width="100%" height="100%"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"><!-- 分页器 --></div>
    </div>
    <div class="font-move">
        <span>公告:天呐来啦!</span>
    </div>
    <!--**************** 九宫格 ********************-->
    <div class="weui-grids" style="background:#fff">
        <!-- 第一个宫格 -->
        <a href="/goods?category_id=1" class="weui-grid">
            <!-- 图标 -->
            <div class="weui-grid__icon">
                <img src="/images/food.png" alt="">
            </div>
            <!-- 标签文字 -->
            <p class="weui-grid__label">校园外卖</p>
        </a>
        <a href="#" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="/images/shop.png" alt="">
            </div>
            <p class="weui-grid__label">校园商城</p>
        </a>
        <a href="#" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="/images/car.png" alt="">
            </div>
            <p class="weui-grid__label">车宝通</p>
        </a>
        <a href="/goods?category_id=2" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="/images/Fruits.png" alt="">
            </div>
            <p class="weui-grid__label">水果超市</p>
        </a>
        <a href="#" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="/images/chat.png" alt="">
            </div>
            <p class="weui-grid__label">校园圈子</p>
        </a>
        <a href="#" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="/images/horn.png" alt="">
            </div>
            <p class="weui-grid__label">校内通</p>
        </a>
    </div>
    <!-- 商品列表-->
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <span style="font-size: 14px; color: orange"><i class="fa fa-heart"></i> 精品推荐</span>
        </div>
        <div class="weui-cell__ft"></div>
    </div>
    <div class="me-goods-List">
        @foreach($best_goods as $goods)
            <div class="shopp-item">
                <a class="me-on-a me-a" href="/goods/{{ $goods->id }}">
                    <img class="img-responsive " src="{{ $goods->mid_image }}"/>
                    <p>{{ $goods->name }}</p>
                </a>
                <p>
                    <span>
                        <i class="fa fa-rmb"></i>{{ $goods->price }}
                    </span>
                    <small>销量:{{ $goods->buy_count }}</small>
                    <a class=" fa fa-cart-plus fa-lg"></a>
                </p>
            </div>
        @endforeach
    </div>
    <div class="height-4rem"></div>
    <!--**********   底部导航  **************-->
    @include('layouts.bottom_nav')
@stop
@section('js')
    <script src="/plugins/swiper/swiper.min.js">/*这是轮播框架*/</script>
    <script src="/js/home.js"></script>
<script>

</script>
@stop
