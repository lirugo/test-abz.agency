@extends('_layouts.app')

@section('content')
        <!-- отображаем тут компонент, для которого совпадает маршрут -->
        <router-view></router-view>

    {{--<v-layout>--}}
        {{--<v-flex xs12>--}}
            {{--<widget-employee></widget-employee>--}}
        {{--</v-flex>--}}
    {{--</v-layout>--}}
@endsection