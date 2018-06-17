@extends('main') @section('title', 'Homepage') @section('content')

<div class="straatnaam text-center">
        <div class="container">
            <div class="header">
                <h1 class="text-bold" >De Vlaamse straatnamen</h1>
                <h3 style="font-family: 'PT Mono', monospace;">Straatnamen bieden een glimp op de gischiedenis en cultuur van een streek. Een analyse van de 91.731 straatnamen in Vlaanderen en Brussel levert enkele interessante inzichten op.</h3>

            </div>
        </div>
      
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3 col-xs-12">
                    <div>
                    <a onclick="location.href='{{ route('straat') }}'">  <h3 class="text-bold" style="color:#c6403e">Straatnamen</h3></a>
                       <div class="row">
                       <a onclick="location.href='{{ route('straat') }}'"> <h4 class="h3">Waar komt welke straatnaam voor?</h3></a>
                       
                            <div class="col-xs-12">
                                <div class="itemen">
                                <a onclick="location.href='{{ route('straat') }}'"><img src="../images/straten.png" height="200px" width="100%" /></a>
                              
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
          
                <div class="col-md-3 col-xs-12">
                    <div>
                    <a onclick="location.href='{{ route('personen') }}'"> <h3 class="text-bold" style="color:#c6403e">Personen</h3></a>
                       <div class="row">
                       <a onclick="location.href='{{ route('personen') }}'"> <h4 class="h3">Naar wie zijn onze straten vernoemd?</h3></a>
                           
                            <div class="col-xs-12">
                                <div class="itemen">
                                <a onclick="location.href='{{ route('personen') }}'"><img src="../images/personen.png" height="200px" width="100%" /></a>
                            
                                </div>
                            </div>
                       

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div>
                    <a onclick="location.href='{{ route('antwerpen') }}'"><h3 class="text-bold" style="color:#c6403e">Antwerpen</h3></a>
                        <div class="row">
                        <a onclick="location.href='{{ route('antwerpen') }}'"> <h4 class="h3">Wat valt er te leren uit de Antwerpse straatnemen?</h3></a>
                       
                            <div class="col-xs-12">
                                <div class="itemen">
                                <a onclick="location.href='{{ route('antwerpen') }}'"><img src="../images/homeantwerpen.png" height="200px" width="100%" /></a>
                            
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div>
                    <a onclick="location.href='{{ route('gemeente') }}'"> <h3 class="text-bold" style="color:#c6403e">Gemeenten</h3> </a>
                        <div class="row">
                        <a onclick="location.href='{{ route('gemeente') }}'"> <h4 class="h3">Welke straatnamen komen voor in jow gemeente?</h3></a>
                       
                            <div class="col-xs-12">
                                <div class="itemen">
                                <a onclick="location.href='{{ route('gemeente') }}'"><img src="../images/gemeenten.png" height="200px" width="100%" /></a></a>
                                
                                </div>
                            </div>
                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endSection @section('script')
<script>

</script>
@endSection