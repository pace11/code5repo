@extends('layouts.app')

@section('title'){{ empty($meta->title) ? $promo->title : $meta->title }} | DISITU.COM @endsection

@section('description'){{$meta->description}}@endsection

@section('head')
    <style>
        .vertical-left-right{
            border-left: 2px solid #eee;
            border-right: 2px solid #eee;
        }
        .vertical-bottom{
            border-bottom: 2px solid #eee;
        }
        .active-bottom{
            border-bottom: 3px solid #8F2323;
            padding-bottom: 10px;
        }
        .vertical-left{
            border-left: 1px solid #eee;
        }
        .row-margin{
            margin-bottom: 1%;
            margin-top: 2%;
        }
        .choice{
            cursor: pointer;
        }
        
        #share .jssocials-share{
            float:right;
            margin-left:10%;
        }
        .hastag{
            background-color:#eeeeee;
            border:1px solid #b3b3b3;
            border-radius:5px;
            color:#000;
            padding:10px 15px 10px 15px;
            font-size:11px;
            margin-bottom:10px;
            margin-right: 2%;
        }

        #share {
            position: relatif;
            padding-left: 20px;
        }

        #share .jssocials-share {
            display: block; 
            margin: 0; 
            margin-bottom: 1.5em;
            float: none;
        }

    </style>
@endsection

@section('content')
    <div class="text-center" style="margin-bottom:2%;">
        <?php 
            $splitName = explode('||', $promo->imageUrl, 2);
            $last_name = !empty($splitName[0]) ? $splitName[0] : 'https://disitucom.azureedge.net/static/images/no-thumbnail.png';
        ?>
        <img src="{{$last_name}}" alt="{{$last_name}}" style="width:100%">
    </div>
    <div class="container">
        <div class="row row-margin text-center">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1>{{!empty($promo->title) ? $promo->title : ""}}</h1>
                <div class="row vertical-bottom">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <img src="https://disituapi.azureedge.net/LOGOMF/{{$promo->producer}}.png" alt="https://disituapi.azureedge.net/LOGOMF/{{$promo->producer}}.png" style="width:30%;">
                    </div>
                </div>
                <div class="row">
                
                </div>
                <div class="row row-margin vertical-bottom">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p style="text-align: left; font-size: 12px;">Kategori Promo</p>
                        <p style="font-weight: bold; font-size: 20px;">{{$promo->category}}</p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4 vertical-left-right">
                        <p style="text-align: left; font-size: 12px;">Periode Awal Promo</p>
                        <p style="font-weight: bold; font-size: 20px;">{{Helper::dateFormat($promo->startDate)}}</p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p style="text-align: left; font-size: 12px;">Periode Akhir Promo</p>
                        <p style="font-weight: bold; font-size: 20px;">{{Helper::dateFormat($promo->endDate)}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom:2%;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row" style="margin-bottom: 2%;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(!empty($promo->content))
                            {!!$promo->content!!}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="row" style="margin-bottom:2%;">
            <div class="col-md-1 col-sm-1 col-xs-1">
                <div id="share">
                
                </div> 
            </div>
            <div class="col-md-11 col-sm-11 col-xs-11">
                <p style="font-weight: bold; color:black;" class="vertical-bottom">Syarat dan Ketentuan</p>
                <div class="row" style="margin-bottom: 5%;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(!empty($promo->termAndCondition))
                            {!!$promo->termAndCondition!!}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom')
<script src="https://disitucom.azureedge.net/static/js/jssocials.min.js"></script>
<script type="text/javascript">

var _socmedType;

    $("#share").jsSocials({
		showLabel: false,
		showCount: true,
		shareIn: "popup",
		shares: ["twitter", "facebook", "googleplus", "linkedin", "whatsapp"],
		on: {
			click: function(e) {
				console.log(this.share);
				_socmedType = this.share;
				$.getJSON('pace', { 'provider':  this.share, 'id': pace }, function(data) {
					console.log(data)
				});
				if(UUID_USER != null){
		            setTimeout(function() {
		            	addPoint(this.share);
					  //your code to be executed after 1 second
					}, 5000);
    			}
			}
		}
	});

    function shareHandler(){
		event.stopPropagation();

		var sharebutton;
		var currentEl = event.target.nodeName;

		if(currentEl === "I"){
			sharebutton = $(event.target).parent().parent().children(".sharebox").children(".sharebutton");
		}
		else{
			sharebutton = $(event.target).parent().children(".sharebox").children(".sharebutton");
		}
		
		if(sharebutton.hasClass("show-elements")){
			sharebutton.addClass("hide-elements");
            sharebutton.removeClass("show-elements");
		}
		else if(sharebutton.hasClass("hide-elements")){
			$(".sharebutton").attr("class", "sharebutton hide-elements");
			sharebutton.addClass("show-elements");
			sharebutton.removeClass("hide-elements");
		}
	}
</script>
@endsection