<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Minnesota Open Enrollment</title>
  <meta name="description" content="Minnesota Open Enrollment">
  <meta name="author" content="Jeff Hargarten - StarTribune">

  <link href="js/nvd3-master/src/nv.d3.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/special/data_tables/media/css/demo_page.css">
  <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/special/data_tables/media/css/demo_table.css">
  <link rel="stylesheet" href="../_common_resources/styles/startribune_dataviz_styles.css" />
  
<style>
    .background { fill:none; pointer-events:all; }
    #states { fill:#aaa; }
    #state-borders { fill:none; pointer-events:none; stroke:#fff; stroke-linecap:round; stroke-linejoin:round; stroke-width:1.5px; }
    path:hover { cursor:pointer; fill:#333 !important; }
    #states .active { fill:#333 !important; fill-opacity:1 !important; }
    #states .active:hover { fill:#333 !important; }
    #timeline { font-weight:900; }
    .selected { color:black !important; font-weight:900; text-decoration:none !important; }
    .legend label, .legend span { color:#808080; display:block; float:left; font-size:11px; height:15px; text-align:center; width:9%; }
    .bubble { fill-opacity:.8; stroke:#000; stroke-width:.2px; }
    circle:hover { cursor:pointer; fill:#333 !important; fill-opacity:1; stroke:#fff; stroke-width:.2px; }
    line { opacity:0; stroke:#999; }
    .myButton { background-color:#ddd; border:0; border-radius:0; color:#000; cursor:pointer; display:inline-block; font-family:arial; font-size:13px; margin-bottom:5px; font-weight:900; moz-border-radius:0; padding:13px 26px; text-decoration:none; webkit-border-radius:0; width:24.5%; }
    .myButton:hover { background-color:#5cbf2a !important; }
    .myButton:active { background-color:#5cbf2a; }
    .selected { color:#fff !important; background-color:#333; }
    button:focus { outline:0 !important; }
    #wrapper { position:relative; width:100%; }
    .mappage { height:850px !important; width:100%; }
    label > input { display:none; }
    label > input + img { border:2px solid transparent; cursor:pointer; width:60px; }
    label > input:checked + img { border:2px solid #ddd; }
    #infobox { height:20px; padding-bottom:0; padding-left:10px; padding-right:10px; padding-top:0; text-align:center !important; width:260px; }
    #sidebox { background:#fff !important; border-color:#ddd; border-style:solid; border-width:2px; float:right; height:800px; position:absolute; right:0; top:10%; width:280px; }
    .category { float:left; }
    .amount { float:right; }
    hr { background:#999; border:0; border-bottom:1px dashed #ccc; clear:both; }
    .faded { fill-opacity:0 !important; }
    .faded:hover { fill:#333 !important; fill-opacity:1 !important; }
    .faded2 { fill:#ddd !important; fill-opacity:0 !important; stroke:#333 !important; stroke-width:.6px !important; }
    .faded2:hover { fill:#333 !important; fill-opacity:1 !important; stroke:#333 !important; stroke-width:.6px !important; }
    .h1 { fill:#edf8e9 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .h2 { fill:#bae4b3 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .h3 { fill:#74c476 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .h4 { fill:#31a354 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .h5 { fill:#006d2c !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .h6 { fill:#003a17 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .hn1 { fill:#fee5d9 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .hn2 { fill:#fcae91 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; }
    .hn3 { fill:#fb6a4a !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .hn4 { fill:#de2d26 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .hn5 { fill:#a50f15 !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .hn6 { fill:#57080b !important; fill-opacity:.9 !important; stroke:#000 !important; stroke-opacity:1 !important; stroke-width:1px; }
    .mix { fill:#ddd !important; fill-opacity:.9 !important; stroke:#ddd !important; stroke-opacity:1 !important; stroke-width:3px; }
    .clicked { fill:#333 !important; fill-opacity:1 !important; stroke:#333 !important; stroke-opacity:1 !important; stroke-width:3px !important; }
    .county_header { font-weight:bold; }
    .neg_change { color:#a50f15 !important; font-weight:bold; }
    .pos_change { color:#006d2c !important; font-weight:bold; }
    .change { color:#000; font-weight:bold; }
    .nvtooltip { background-color:rgba(255,255,255,1); border:1px solid #000; border-radius:0; font-family:Arial; font-size:16px; khtml-user-select:none; moz-border-radius:0; moz-transition:opacity 200ms linear; moz-transition-delay:200ms; moz-user-select:none; ms-user-select:none; padding:10px; pointer-events:none; position:absolute; transition:opacity 200ms linear; transition-delay:200ms; user-select:none; webkit-touch-callout:none; webkit-transition:opacity 200ms linear; webkit-transition-delay:200ms; webkit-user-select:none; width:auto; z-index:10000; }
    .nvtooltip h3 { background:white !important; font-size:16px; font-weight:bold; margin:0; padding:2px; text-align:left; }
    .nvtooltip p { margin:0; padding:0; }
    .nvtooltip span { display:inline-block; margin:2px 0; }
    .nvtooltip-pending-removal { pointer-events:none; position:absolute; }
    .tooltip { background-color:rgba(255,255,255,1); border:1px solid black; border-radius:0; font-family:Arial; font-size:16px; height:auto; margin:10px; padding:10px; width:auto; }
    #graph svg rect:hover { fill:#333 !important; }
    .clickified { background:#333 !important; color:white; }
    td { font-family:Arial; padding:8.88px !important; }
    tr.odd td.sorting_1 { background-color:#efefef; }
    tr.even td.sorting_1 { background-color:#efefef; }
    tr.even { background-color:white !important; }
    tr.odd { background-color:#efefef !important; }
    .dataTables_length { display:none; }
    .dataTables_filter { float:left; font-size:1em; font-weight:bold; height:10px; padding-bottom:13px; text-align:left; }
    .dataTables_filter input { display:block; visibility:visible; width:275px; }
    .dataTable { margin-bottom:18px; }
    .dataTables_info { display:none; }
    .dataTables_scrollHead { display:none; }
    th { background:#ccc !important; }
    th:hover { cursor:pointer; }
    tr:hover { border:1px solid black !important; }
    .District-cell { font-size:12px; font-weight:900; }
    .District-cell:hover { background:#333 !important; color:white; cursor:pointer; }
    .dataTables_scrollHeadInner { box-sizing:initial !important; height:37px !important; padding-left:0 !important; width:100% !important; }
    table.dataTable.no-footer { margin-bottom:0 !important; }
    .dataTables_scrollBody thead { height:0 !important; visibility:hidden; }
    th.sorting_asc, th.sorting_desc { background:#333 !important; color:#fff; font-weight:bold; }
    th { display:table-cell; vertical-align:initial; }
    .dataTables_scrollHead { height:37px !important; }
    #canvas rect:hover { fill:#333; stroke:#333; }
    #graph { height:240px !important; width:280px !important; }
    #bubble_legend { height:240px !important; width:260px !important; }
    #bubble_legend p { font-size:14px; padding:10px; }
    .legend_lable { font-weight:bold !important; line-height:150% !important; text-align:center !important; }
    #nerdbox { font-size:14px; padding:20px; }
    hr { border:0; border-bottom:1px solid #eee !important; border-top:0 !important; height:0; margin:0; }
    rect.negative { fill:#de2d26 !important; stroke:#de2d26 !important; }
    rect.positive { fill:#31a354 !important; stroke:#31a354 !important; }

    @media (max-width: 700px) {
      #sidebox { width:100%; float:none; display:block; position:relative; }
      .mappage { clear:both !important; margin:10px; height:400px !important; }
      .mappage svg { height:400px !important; }
      #graph { width:100% !important; }
      .myButton { width:49.5%; }
      .dataTables_filter { width:100% !important; }
      .dataTables_filter input { width:100% !important; }
      #bubble_legend { width: 100% !important; }
    }
</style>

<body>

<div id="wrapper">

<div id="timeline">
<button id="cartage" class="myButton">All</button>
<button id="race" class="myButton">Race</button>
<button id="income" class="myButton">Income</button>
<button id="mappage" class="myButton">Charters</button>
</div>

<p></p>

<a href="javascript:void(0);" id="zoom">Reset View</a>

<p></p>

<div>
<div id="map1314" class="mappage"><svg height="400" viewBox="0 0 1200 850" preserveAspectRatio="xMidYMid"></svg></div>
<div id="map1213" class="mappage"><svg height="400" viewBox="0 0 1200 850" preserveAspectRatio="xMidYMid"></svg></div>
</div>

<div id="infobox" style="display:none;"></div>

<div id="sidebox">

<div id="change" style="clear:both !important;">
<div class="legend_lable">Percent change in student population</div>
<div class='legend'>
  <nav class='legend clearfix'>
    <span style='background:#fff;'>-</span>
    <span style='background:#252525;'></span>
    <span style='background:#4f4f4f;'></span>
    <span style='background:#888888;'></span>
    <span style='background:#d9d9d9;'></span>
    <span style='background:#fff;'>0</span>
    <span style='background:#bae4b3;'></span>
    <span style='background:#74c476'></span>
    <span style='background:#31a354'></span>
    <span style='background:#006d2c'></span>
    <span style='background:#fff;'>+</span>
</div>
</div>

<div id="migrate" style="clear:both !important;">
<div class="legend_lable">Net student migration</div>
<div class='legend'>
  <nav class='legend clearfix'>
    <span style='background:#fff;'>to</span>
    <span style='background:#a50f15;'></span>
    <span style='background:#de2d26;'></span>
    <span style='background:#fb6a4a;'></span>
    <span style='background:#fcae91;'></span>
    <span style='background:#fff;'>0</span>
    <span style='background:#bae4b3;'></span>
    <span style='background:#74c476'></span>
    <span style='background:#31a354'></span>
    <span style='background:#006d2c'></span>
    <span style='background:#fff;'>from</span>
  </nav>
</div>
</div>

<div id="bubble_legend">

<div id="nerdbox">
<h3>Open enrollment migrations</h3>

Graphics depict data from 2013-2014 academic year unless otherwise noted.<br /><br />
Default view shows percentage change in student population from the previous year.<br /><br />
Clicking shows migration of students to and from the selected district.</div>
</div>

<div id="graph"><svg></svg></div>

<table id="district_select">
  <thead>
    <tr>
      <th class="District-cell">District</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="District-cell">Aitkin</td>
    </tr>
    <tr>
      <td class="District-cell">Minneapolis</td>
    </tr>
    <tr>
      <td class="District-cell">Hill City</td>
    </tr>
    <tr>
      <td class="District-cell">McGregor</td>
    </tr>
    <tr>
      <td class="District-cell">South Saint Paul</td>
    </tr>
    <tr>
      <td class="District-cell">Anoka-Hennepin</td>
    </tr>
    <tr>
      <td class="District-cell">Centennial</td>
    </tr>
    <tr>
      <td class="District-cell">Columbia Heights</td>
    </tr>
    <tr>
      <td class="District-cell">Fridley</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Francis</td>
    </tr>
    <tr>
      <td class="District-cell">Spring Lake Park</td>
    </tr>
    <tr>
      <td class="District-cell">Detroit Lakes</td>
    </tr>
    <tr>
      <td class="District-cell">Frazee-Vergas</td>
    </tr>
    <tr>
      <td class="District-cell">Pine Point</td>
    </tr>
    <tr>
      <td class="District-cell">Bemidji</td>
    </tr>
    <tr>
      <td class="District-cell">Blackduck</td>
    </tr>
    <tr>
      <td class="District-cell">Kelliher</td>
    </tr>
    <tr>
      <td class="District-cell">Red Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Sauk Rapids-Rice</td>
    </tr>
    <tr>
      <td class="District-cell">Foley</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Clair</td>
    </tr>
    <tr>
      <td class="District-cell">Mankato</td>
    </tr>
    <tr>
      <td class="District-cell">Comfrey</td>
    </tr>
    <tr>
      <td class="District-cell">Sleepy Eye</td>
    </tr>
    <tr>
      <td class="District-cell">Springfield</td>
    </tr>
    <tr>
      <td class="District-cell">New Ulm</td>
    </tr>
    <tr>
      <td class="District-cell">Barnum</td>
    </tr>
    <tr>
      <td class="District-cell">Carlton</td>
    </tr>
    <tr>
      <td class="District-cell">Cloquet</td>
    </tr>
    <tr>
      <td class="District-cell">Cromwell-Wright</td>
    </tr>
    <tr>
      <td class="District-cell">Moose Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Esko</td>
    </tr>
    <tr>
      <td class="District-cell">Wrenshall</td>
    </tr>
    <tr>
      <td class="District-cell">Central</td>
    </tr>
    <tr>
      <td class="District-cell">Waconia</td>
    </tr>
    <tr>
      <td class="District-cell">Watertown-Mayer</td>
    </tr>
    <tr>
      <td class="District-cell">Eastern Carver County</td>
    </tr>
    <tr>
      <td class="District-cell">Walker-Hackensack-Akeley</td>
    </tr>
    <tr>
      <td class="District-cell">Cass Lake-Bena</td>
    </tr>
    <tr>
      <td class="District-cell">Pillager</td>
    </tr>
    <tr>
      <td class="District-cell">Northland Community</td>
    </tr>
    <tr>
      <td class="District-cell">Montevideo</td>
    </tr>
    <tr>
      <td class="District-cell">North Branch</td>
    </tr>
    <tr>
      <td class="District-cell">Rush City</td>
    </tr>
    <tr>
      <td class="District-cell">Barnesville</td>
    </tr>
    <tr>
      <td class="District-cell">Hawley</td>
    </tr>
    <tr>
      <td class="District-cell">Moorhead</td>
    </tr>
    <tr>
      <td class="District-cell">Bagley</td>
    </tr>
    <tr>
      <td class="District-cell">Cook County</td>
    </tr>
    <tr>
      <td class="District-cell">Mountain Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Windom</td>
    </tr>
    <tr>
      <td class="District-cell">Brainerd</td>
    </tr>
    <tr>
      <td class="District-cell">Crosby-Ironton</td>
    </tr>
    <tr>
      <td class="District-cell">Pequot Lakes</td>
    </tr>
    <tr>
      <td class="District-cell">Burnsville-Eagan-Savage</td>
    </tr>
    <tr>
      <td class="District-cell">Farmington</td>
    </tr>
    <tr>
      <td class="District-cell">Lakeville</td>
    </tr>
    <tr>
      <td class="District-cell">Randolph</td>
    </tr>
    <tr>
      <td class="District-cell">Rosemount-Apple Valley-Eagan</td>
    </tr>
    <tr>
      <td class="District-cell">West Saint Paul-Mendota Heights-Eagan</td>
    </tr>
    <tr>
      <td class="District-cell">Inver Grove Heights</td>
    </tr>
    <tr>
      <td class="District-cell">Hastings</td>
    </tr>
    <tr>
      <td class="District-cell">Hayfield</td>
    </tr>
    <tr>
      <td class="District-cell">Kasson-Mantorville</td>
    </tr>
    <tr>
      <td class="District-cell">Alexandria</td>
    </tr>
    <tr>
      <td class="District-cell">Osakis</td>
    </tr>
    <tr>
      <td class="District-cell">Chatfield</td>
    </tr>
    <tr>
      <td class="District-cell">Lanesboro</td>
    </tr>
    <tr>
      <td class="District-cell">Mabel-Canton</td>
    </tr>
    <tr>
      <td class="District-cell">Rushford-Peterson</td>
    </tr>
    <tr>
      <td class="District-cell">Albert Lea</td>
    </tr>
    <tr>
      <td class="District-cell">Alden-Conger</td>
    </tr>
    <tr>
      <td class="District-cell">Cannon Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Goodhue</td>
    </tr>
    <tr>
      <td class="District-cell">Pine Island</td>
    </tr>
    <tr>
      <td class="District-cell">Red Wing</td>
    </tr>
    <tr>
      <td class="District-cell">Ashby</td>
    </tr>
    <tr>
      <td class="District-cell">Herman-Norcross</td>
    </tr>
    <tr>
      <td class="District-cell">Hopkins</td>
    </tr>
    <tr>
      <td class="District-cell">Bloomington</td>
    </tr>
    <tr>
      <td class="District-cell">Eden Prairie</td>
    </tr>
    <tr>
      <td class="District-cell">Edina</td>
    </tr>
    <tr>
      <td class="District-cell">Minnetonka</td>
    </tr>
    <tr>
      <td class="District-cell">Westonka</td>
    </tr>
    <tr>
      <td class="District-cell">Orono</td>
    </tr>
    <tr>
      <td class="District-cell">Osseo</td>
    </tr>
    <tr>
      <td class="District-cell">Richfield</td>
    </tr>
    <tr>
      <td class="District-cell">Robbinsdale</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Anthony-New Brighton</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Louis Park</td>
    </tr>
    <tr>
      <td class="District-cell">Wayzata</td>
    </tr>
    <tr>
      <td class="District-cell">Brooklyn Center</td>
    </tr>
    <tr>
      <td class="District-cell">Houston</td>
    </tr>
    <tr>
      <td class="District-cell">Spring Grove</td>
    </tr>
    <tr>
      <td class="District-cell">Caledonia</td>
    </tr>
    <tr>
      <td class="District-cell">La Crescent-Hokah</td>
    </tr>
    <tr>
      <td class="District-cell">Laporte</td>
    </tr>
    <tr>
      <td class="District-cell">Nevis</td>
    </tr>
    <tr>
      <td class="District-cell">Park Rapids</td>
    </tr>
    <tr>
      <td class="District-cell">Braham</td>
    </tr>
    <tr>
      <td class="District-cell">Greenway</td>
    </tr>
    <tr>
      <td class="District-cell">Deer River</td>
    </tr>
    <tr>
      <td class="District-cell">Grand Rapids</td>
    </tr>
    <tr>
      <td class="District-cell">Nashwauk-Keewatin</td>
    </tr>
    <tr>
      <td class="District-cell">Franconia</td>
    </tr>
    <tr>
      <td class="District-cell">Heron Lake-Okabena</td>
    </tr>
    <tr>
      <td class="District-cell">Mora</td>
    </tr>
    <tr>
      <td class="District-cell">Ogilvie</td>
    </tr>
    <tr>
      <td class="District-cell">New London-Spicer</td>
    </tr>
    <tr>
      <td class="District-cell">Willmar</td>
    </tr>
    <tr>
      <td class="District-cell">Lancaster</td>
    </tr>
    <tr>
      <td class="District-cell">International Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Littlefork-Big Falls</td>
    </tr>
    <tr>
      <td class="District-cell">South Koochiching</td>
    </tr>
    <tr>
      <td class="District-cell">Dawson-Boyd</td>
    </tr>
    <tr>
      <td class="District-cell">Lake Superior</td>
    </tr>
    <tr>
      <td class="District-cell">Lake of the Woods</td>
    </tr>
    <tr>
      <td class="District-cell">Cleveland</td>
    </tr>
    <tr>
      <td class="District-cell">Hendricks</td>
    </tr>
    <tr>
      <td class="District-cell">Ivanhoe</td>
    </tr>
    <tr>
      <td class="District-cell">Lake Benton</td>
    </tr>
    <tr>
      <td class="District-cell">Marshall</td>
    </tr>
    <tr>
      <td class="District-cell">Minneota</td>
    </tr>
    <tr>
      <td class="District-cell">Lynd</td>
    </tr>
    <tr>
      <td class="District-cell">Hutchinson</td>
    </tr>
    <tr>
      <td class="District-cell">Lester Prairie</td>
    </tr>
    <tr>
      <td class="District-cell">Mahnomen</td>
    </tr>
    <tr>
      <td class="District-cell">Waubun-Ogema-White Earth</td>
    </tr>
    <tr>
      <td class="District-cell">Marshall County Central</td>
    </tr>
    <tr>
      <td class="District-cell">Grygla</td>
    </tr>
    <tr>
      <td class="District-cell">Truman</td>
    </tr>
    <tr>
      <td class="District-cell">Eden Valley-Watkins</td>
    </tr>
    <tr>
      <td class="District-cell">Litchfield</td>
    </tr>
    <tr>
      <td class="District-cell">Dassel-Cokato</td>
    </tr>
    <tr>
      <td class="District-cell">Isle</td>
    </tr>
    <tr>
      <td class="District-cell">Princeton</td>
    </tr>
    <tr>
      <td class="District-cell">Onamia</td>
    </tr>
    <tr>
      <td class="District-cell">Little Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Pierz</td>
    </tr>
    <tr>
      <td class="District-cell">Royalton</td>
    </tr>
    <tr>
      <td class="District-cell">Swanville</td>
    </tr>
    <tr>
      <td class="District-cell">Upsala</td>
    </tr>
    <tr>
      <td class="District-cell">Austin</td>
    </tr>
    <tr>
      <td class="District-cell">Grand Meadow</td>
    </tr>
    <tr>
      <td class="District-cell">Lyle</td>
    </tr>
    <tr>
      <td class="District-cell">Leroy-Ostrander</td>
    </tr>
    <tr>
      <td class="District-cell">Southland</td>
    </tr>
    <tr>
      <td class="District-cell">Fulda</td>
    </tr>
    <tr>
      <td class="District-cell">Nicollet</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Peter</td>
    </tr>
    <tr>
      <td class="District-cell">Adrian</td>
    </tr>
    <tr>
      <td class="District-cell">Ellsworth</td>
    </tr>
    <tr>
      <td class="District-cell">Worthington</td>
    </tr>
    <tr>
      <td class="District-cell">Byron</td>
    </tr>
    <tr>
      <td class="District-cell">Dover-Eyota</td>
    </tr>
    <tr>
      <td class="District-cell">Stewartville</td>
    </tr>
    <tr>
      <td class="District-cell">Rochester</td>
    </tr>
    <tr>
      <td class="District-cell">Battle Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Fergus Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Henning</td>
    </tr>
    <tr>
      <td class="District-cell">Parkers Prairie</td>
    </tr>
    <tr>
      <td class="District-cell">Pelican Rapids</td>
    </tr>
    <tr>
      <td class="District-cell">Perham-Dent</td>
    </tr>
    <tr>
      <td class="District-cell">Underwood</td>
    </tr>
    <tr>
      <td class="District-cell">New York Mills</td>
    </tr>
    <tr>
      <td class="District-cell">Goodridge</td>
    </tr>
    <tr>
      <td class="District-cell">Thief River Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Willow River</td>
    </tr>
    <tr>
      <td class="District-cell">Pine City</td>
    </tr>
    <tr>
      <td class="District-cell">Edgerton</td>
    </tr>
    <tr>
      <td class="District-cell">Climax-Shelly</td>
    </tr>
    <tr>
      <td class="District-cell">Crookston</td>
    </tr>
    <tr>
      <td class="District-cell">East Grand Forks</td>
    </tr>
    <tr>
      <td class="District-cell">Fertile-Beltrami</td>
    </tr>
    <tr>
      <td class="District-cell">Fisher</td>
    </tr>
    <tr>
      <td class="District-cell">Fosston</td>
    </tr>
    <tr>
      <td class="District-cell">Mounds View</td>
    </tr>
    <tr>
      <td class="District-cell">North Saint Paul-Maplewood</td>
    </tr>
    <tr>
      <td class="District-cell">Roseville</td>
    </tr>
    <tr>
      <td class="District-cell">White Bear Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Paul</td>
    </tr>
    <tr>
      <td class="District-cell">Red Lake Falls</td>
    </tr>
    <tr>
      <td class="District-cell">Milroy</td>
    </tr>
    <tr>
      <td class="District-cell">Wabasso</td>
    </tr>
    <tr>
      <td class="District-cell">Faribault</td>
    </tr>
    <tr>
      <td class="District-cell">Northfield</td>
    </tr>
    <tr>
      <td class="District-cell">Hills-Beaver Creek</td>
    </tr>
    <tr>
      <td class="District-cell">Badger</td>
    </tr>
    <tr>
      <td class="District-cell">Roseau</td>
    </tr>
    <tr>
      <td class="District-cell">Warroad</td>
    </tr>
    <tr>
      <td class="District-cell">Chisholm</td>
    </tr>
    <tr>
      <td class="District-cell">Ely</td>
    </tr>
    <tr>
      <td class="District-cell">Floodwood</td>
    </tr>
    <tr>
      <td class="District-cell">Hermantown</td>
    </tr>
    <tr>
      <td class="District-cell">Hibbing</td>
    </tr>
    <tr>
      <td class="District-cell">Proctor</td>
    </tr>
    <tr>
      <td class="District-cell">Virginia</td>
    </tr>
    <tr>
      <td class="District-cell">Nett Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Duluth</td>
    </tr>
    <tr>
      <td class="District-cell">Mountain Iron-Buhl</td>
    </tr>
    <tr>
      <td class="District-cell">Belle Plaine</td>
    </tr>
    <tr>
      <td class="District-cell">Jordan</td>
    </tr>
    <tr>
      <td class="District-cell">Prior Lake-Savage</td>
    </tr>
    <tr>
      <td class="District-cell">Shakopee</td>
    </tr>
    <tr>
      <td class="District-cell">New Prague Area</td>
    </tr>
    <tr>
      <td class="District-cell">Becker</td>
    </tr>
    <tr>
      <td class="District-cell">Big Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Elk River</td>
    </tr>
    <tr>
      <td class="District-cell">Holdingford</td>
    </tr>
    <tr>
      <td class="District-cell">Kimball</td>
    </tr>
    <tr>
      <td class="District-cell">Melrose</td>
    </tr>
    <tr>
      <td class="District-cell">Paynesville</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Cloud</td>
    </tr>
    <tr>
      <td class="District-cell">Sauk Centre</td>
    </tr>
    <tr>
      <td class="District-cell">Albany</td>
    </tr>
    <tr>
      <td class="District-cell">Sartell-Saint Stephen</td>
    </tr>
    <tr>
      <td class="District-cell">Rocori</td>
    </tr>
    <tr>
      <td class="District-cell">Blooming Prairie</td>
    </tr>
    <tr>
      <td class="District-cell">Owatonna</td>
    </tr>
    <tr>
      <td class="District-cell">Medford</td>
    </tr>
    <tr>
      <td class="District-cell">Hancock</td>
    </tr>
    <tr>
      <td class="District-cell">Chokio-Alberta</td>
    </tr>
    <tr>
      <td class="District-cell">Kerkhoven-Murdock-Sunburg</td>
    </tr>
    <tr>
      <td class="District-cell">Benson</td>
    </tr>
    <tr>
      <td class="District-cell">Bertha-Hewitt</td>
    </tr>
    <tr>
      <td class="District-cell">Browerville</td>
    </tr>
    <tr>
      <td class="District-cell">Browns Valley</td>
    </tr>
    <tr>
      <td class="District-cell">Wheaton Area</td>
    </tr>
    <tr>
      <td class="District-cell">Wabasha-Kellogg</td>
    </tr>
    <tr>
      <td class="District-cell">Lake City</td>
    </tr>
    <tr>
      <td class="District-cell">Prinsburg</td>
    </tr>
    <tr>
      <td class="District-cell">Verndale</td>
    </tr>
    <tr>
      <td class="District-cell">Sebeka</td>
    </tr>
    <tr>
      <td class="District-cell">Menahga</td>
    </tr>
    <tr>
      <td class="District-cell">Waseca</td>
    </tr>
    <tr>
      <td class="District-cell">Forest Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Mahtomedi</td>
    </tr>
    <tr>
      <td class="District-cell">South Washington County</td>
    </tr>
    <tr>
      <td class="District-cell">Stillwater Area</td>
    </tr>
    <tr>
      <td class="District-cell">Butterfield-Odin</td>
    </tr>
    <tr>
      <td class="District-cell">Madelia</td>
    </tr>
    <tr>
      <td class="District-cell">Saint James</td>
    </tr>
    <tr>
      <td class="District-cell">Breckenridge</td>
    </tr>
    <tr>
      <td class="District-cell">Rothsay</td>
    </tr>
    <tr>
      <td class="District-cell">Campbell-Tintah</td>
    </tr>
    <tr>
      <td class="District-cell">Lewiston-Altura</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Charles</td>
    </tr>
    <tr>
      <td class="District-cell">Winona Area</td>
    </tr>
    <tr>
      <td class="District-cell">Annandale</td>
    </tr>
    <tr>
      <td class="District-cell">Buffalo-Hanover-Montrose</td>
    </tr>
    <tr>
      <td class="District-cell">Delano</td>
    </tr>
    <tr>
      <td class="District-cell">Maple Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Monticello</td>
    </tr>
    <tr>
      <td class="District-cell">Rockford</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Michael-Albertville</td>
    </tr>
    <tr>
      <td class="District-cell">Canby</td>
    </tr>
    <tr>
      <td class="District-cell">Cambridge-Isanti</td>
    </tr>
    <tr>
      <td class="District-cell">Milaca</td>
    </tr>
    <tr>
      <td class="District-cell">Ulen-Hitterdal</td>
    </tr>
    <tr>
      <td class="District-cell">Lake Crystal-Wellcome Memorial</td>
    </tr>
    <tr>
      <td class="District-cell">Triton</td>
    </tr>
    <tr>
      <td class="District-cell">United South Central</td>
    </tr>
    <tr>
      <td class="District-cell">Maple River</td>
    </tr>
    <tr>
      <td class="District-cell">Kingsland</td>
    </tr>
    <tr>
      <td class="District-cell">Saint Louis County</td>
    </tr>
    <tr>
      <td class="District-cell">Waterville-Elysian-Morristown</td>
    </tr>
    <tr>
      <td class="District-cell">Chisago Lakes</td>
    </tr>
    <tr>
      <td class="District-cell">Minnewaska</td>
    </tr>
    <tr>
      <td class="District-cell">Eveleth-Gilbert</td>
    </tr>
    <tr>
      <td class="District-cell">Wadena-Deer Creek</td>
    </tr>
    <tr>
      <td class="District-cell">Buffalo Lake-Hector-Stewart</td>
    </tr>
    <tr>
      <td class="District-cell">Dilworth-Glyndon-Felton</td>
    </tr>
    <tr>
      <td class="District-cell">Hinckley-Finlayson</td>
    </tr>
    <tr>
      <td class="District-cell">Lakeview</td>
    </tr>
    <tr>
      <td class="District-cell">N.R.H.E.G.</td>
    </tr>
    <tr>
      <td class="District-cell">Murray County Central</td>
    </tr>
    <tr>
      <td class="District-cell">Staples-Motley</td>
    </tr>
    <tr>
      <td class="District-cell">Kittson Central</td>
    </tr>
    <tr>
      <td class="District-cell">Kenyon-Wanamingo</td>
    </tr>
    <tr>
      <td class="District-cell">Pine River-Backus</td>
    </tr>
    <tr>
      <td class="District-cell">Warren-Alvarado-Oslo</td>
    </tr>
    <tr>
      <td class="District-cell">MACCRAY</td>
    </tr>
    <tr>
      <td class="District-cell">Luverne</td>
    </tr>
    <tr>
      <td class="District-cell">Yellow Medicine East</td>
    </tr>
    <tr>
      <td class="District-cell">Fillmore Central</td>
    </tr>
    <tr>
      <td class="District-cell">Norman County East</td>
    </tr>
    <tr>
      <td class="District-cell">Sibley East</td>
    </tr>
    <tr>
      <td class="District-cell">Clearbrook-Gonvick</td>
    </tr>
    <tr>
      <td class="District-cell">West Central Area</td>
    </tr>
    <tr>
      <td class="District-cell">Tri-County</td>
    </tr>
    <tr>
      <td class="District-cell">Belgrade-Brooten-Elrosa</td>
    </tr>
    <tr>
      <td class="District-cell">GFW</td>
    </tr>
    <tr>
      <td class="District-cell">ACGC</td>
    </tr>
    <tr>
      <td class="District-cell">Le Sueur-Henderson</td>
    </tr>
    <tr>
      <td class="District-cell">Martin County West</td>
    </tr>
    <tr>
      <td class="District-cell">Norman County West</td>
    </tr>
    <tr>
      <td class="District-cell">Bird Island-Olivia-Lake Lillian</td>
    </tr>
    <tr>
      <td class="District-cell">Granada-Huntley-East Chain</td>
    </tr>
    <tr>
      <td class="District-cell">East Central</td>
    </tr>
    <tr>
      <td class="District-cell">Win-E-Mac</td>
    </tr>
    <tr>
      <td class="District-cell">Greenbush-Middle River</td>
    </tr>
    <tr>
      <td class="District-cell">Howard Lake-Waverly-Winsted</td>
    </tr>
    <tr>
      <td class="District-cell">Pipestone Area</td>
    </tr>
    <tr>
      <td class="District-cell">Mesabi East</td>
    </tr>
    <tr>
      <td class="District-cell">Fairmont Area</td>
    </tr>
    <tr>
      <td class="District-cell">Long Prairie-Grey Eagle</td>
    </tr>
    <tr>
      <td class="District-cell">Cedar Mountain</td>
    </tr>
    <tr>
      <td class="District-cell">Eagle Valley</td>
    </tr>
    <tr>
      <td class="District-cell">Morris Area</td>
    </tr>
    <tr>
      <td class="District-cell">Zumbrota-Mazeppa</td>
    </tr>
    <tr>
      <td class="District-cell">Janesville-Waldorf-Pemberton</td>
    </tr>
    <tr>
      <td class="District-cell">Lac Qui Parle Valley</td>
    </tr>
    <tr>
      <td class="District-cell">Ada-Borup</td>
    </tr>
    <tr>
      <td class="District-cell">Stephen-Argyle Central</td>
    </tr>
    <tr>
      <td class="District-cell">Glencoe-Silver Lake</td>
    </tr>
    <tr>
      <td class="District-cell">Blue Earth Area</td>
    </tr>
    <tr>
      <td class="District-cell">Red Rock Central</td>
    </tr>
    <tr>
      <td class="District-cell">Glenville-Emmons</td>
    </tr>
    <tr>
      <td class="District-cell">Clinton-Graceville-Beardsley</td>
    </tr>
    <tr>
      <td class="District-cell">Lake Park-Audubon</td>
    </tr>
    <tr>
      <td class="District-cell">Renville County West</td>
    </tr>
    <tr>
      <td class="District-cell">Jackson County Central</td>
    </tr>
    <tr>
      <td class="District-cell">Redwood Area</td>
    </tr>
    <tr>
      <td class="District-cell">Westbrook-Walnut Grove</td>
    </tr>
    <tr>
      <td class="District-cell">Plainview-Elgin-Millville</td>
    </tr>
    <tr>
      <td class="District-cell">Russell-Tyler-Ruthton</td>
    </tr>
    <tr>
      <td class="District-cell">Ortonville</td>
    </tr>
    <tr>
      <td class="District-cell">Tracy Area</td>
    </tr>
    <tr>
      <td class="District-cell">Tri-City United</td>
    </tr>
    <tr>
      <td class="District-cell">Red Lake County Central</td>
    </tr>
    <tr>
      <td class="District-cell">Round Lake-Brewster</td>
    </tr>
    <tr class="lastRow">
      <td class="District-cell">Brandon-Evansville</td>
    </tr>
  </tbody>
</table>
</div>

</div>
</div>

<divCursor id="divCursor" style="position:absolute"> </divCursor>

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/nvd3-master/lib/d3.v3.js"></script>
<script src="js/nvd3-master/nv.d3.js"></script>
<script src="js/nvd3-master/src/utils.js"></script>
<script src="js/nvd3-master/src/tooltip.js"></script>
<script src="js/nvd3-master/src/models/legend.js"></script>
<script src="js/nvd3-master/src/models/axis.js"></script>
<script src="js/nvd3-master/examples/stream_layers.js"></script>
<script src="http://d3js.org/topojson.v1.min.js"></script>
<script src="lib/d3.v2.min.js"></script>
<script src="lib/topojson.js"></script>
<script src="lib/cartogram.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" language="javascript" src="http://wcfcourier.com/app/special/data_tables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="http://wcfcourier.com/app/special/data_tables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="http://wcfcourier.com/app/special/data_tables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/sorting/formatted-numbers.js"></script>

<script>    
  $(document).ready(function(){
    oTable =   $('#district_select').dataTable({"iDisplayLength": 9, "oLanguage": {"sSearch": ""}, "scrollY": "510px", "scrollCollapse": true, "paging": false,});

  });

jQuery.fn.d3Click = function () {
  this.each(function (i, e) {
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);

    e.dispatchEvent(evt);
  });
};

jQuery.fn.d3Down = function () {
  this.each(function (i, e) {
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);

    e.dispatchEvent(evt);
  });
};

jQuery.fn.d3Up = function () {
  this.each(function (i, e) {
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("mouseup", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);

    e.dispatchEvent(evt);
  });
};

var g;

$( document ).ready(function() {
  $( "#map1213" ).hide();
  $( "#map1314" ).show();
  $("#cartage").addClass("selected");
  $( "#migrate" ).hide();
  $( "#change" ).show();
  $( "#graph" ).hide();
  $( "#bubble_legend" ).show();

$( ".myButton" ).click(function() {
  $("td.District-cell").removeClass("clickified");
  $(".myButton").removeClass("selected");
  $(this).addClass("selected");
  oTable.fnFilter('');
  }); 
$( "#cartage" ).click(function() {
    $("td.District-cell").removeClass("clickified");
  $( "#map1314" ).show();
  $( "#map1213" ).hide();
  $( "#graph" ).hide();
  $( "#bubble_legend" ).show();
  }); 
$( "#mappage" ).click(function() {
    $("td.District-cell").removeClass("clickified");
  $( "#map1314" ).hide();
  $( "#map1213" ).show();
  $( "#graph" ).hide();
  $( "#bubble_legend" ).show();
  }); 
$( "td.District-cell" ).click(function() {
    $("td.District-cell").removeClass("clickified");
    $(this).addClass("clickified");
    school = $(this).text();

  $( "#migrate" ).show();
  $( "#change" ).hide();
  $( "#graph" ).show();
  $( "#bubble_legend" ).hide();

  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "']").d3Down();
  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "']").d3Up();
  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "']").d3Click();

  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "_m']").d3Click();
  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "_m']").d3Down();
  $("[id='" + school.replace(new RegExp(" ", "g"),"-") + "_m']").d3Up();


});

});

var chart;
nv.addGraph(function() {
    chart = nv.models.multiBarChart()
        .x(function(d) { return d.label })
        .y(function(d) { return d.value })
      .transitionDuration(350)
      .reduceXTicks(true)   //If 'false', every single x-axis tick label will be rendered.
      .rotateLabels(0)      //Angle to rotate x-axis labels.
      .showControls(false)   //Allow user to switch between 'Grouped' and 'Stacked' mode.
      .showLegend(false)
      .showXAxis(false)
      .groupSpacing(0.1)    //Distance between each group of bars.
      //.color(function(d,i){ console.log(d.values[i].value); if (d.values[i].value > 0){ return ['#31a354']; } else { return ['#de2d26']; } })
      .tooltip(function(key, x, y, e, graph) {
var format = d3.format('');
var y_val = Number(format(y));
if ((e.series.name == "Houston") || (e.series.name == "Houston_m")){ clicked_stay(); }
if ((e.series.name == "Minnetonka") || (e.series.name == "Minnetonka_m")){ return "<h3>" + x + "</h3>" + "<span class='pos_change'>+" +  y + "</span> <span>" + key + "</span>"; }
else if (y_val > 0) { return "<h3>" + x + "</h3>" + "<span class='pos_change'>+" +  y + "</span> <span>" + key + "</span>"; }
else { return "<h3>" + x + "</h3>" + "<span class='neg_change'>" +  y + "</span> <span>" + key + "</span>"; }
});

    chart.yAxis
        .tickFormat(d3.format(',d'));

    d3.select('#graph svg')
        .datum(dummyData)
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
});

function redrawChart(data){
    d3.select('#graph svg').datum(data).transition().duration(500).call(chart);
    nv.utils.windowResize(chart.update);
}

var dummyData = [
  {
    "key": "students migrated",
    "values": [
      { 
        "label" : "2009-2010" ,
        "value" : 0
      },
      { 
        "label" : "2010-2011" ,
        "value" : 0
      },
      { 
        "label" : "2011-2012" ,
        "value" : 0
      },
      { 
        "label" : "2012-2013" ,
        "value" : 0
      },
      { 
        "label" : "2013-2014" ,
        "value" : 0
      }
    ]
  }
]

// var data1314 = "enroll_13_14.csv";
// var data1213 = "enroll_12_13.csv";
// var data1112 = "enroll_11_12.csv";
// var data1011 = "enroll_10_11.csv";
// var data0910 = "enroll_09_10.csv";
// var flow1314 = "flow_13_14.csv";
// var flow1213 = "flow_12_13.csv";
// var flow1112 = "flow_11_12.csv";
// var flow1011 = "flow_10_11.csv";
// var flow0910 = "flow_09_10.csv";

//updateData(data1314, flow1314);
//LIVE JSON MAGIC

//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=enroll_09_10
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=enroll_10_11
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=enroll_11_12
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=enroll_12_13
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=enroll_13_14
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=flow_09_10
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=flow_10_11
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=flow_11_12
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=flow_12_13
//https://script.google.com/macros/s/AKfycbwG7mX6qPZaIhkwY2AJ2lU7kNarbm6OWIkWVfnmYZGYruIl40cu/exec?id=1ZwC2kGP2MjL9f-3zFZhD5sPtZ8B15PnMV7ShzwTKmuI&sheet=flow_13_14

<?php

$jsonDataEnroll0910 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=-QhCu0R5kCv_9mIJ26pLqi_4QfH5ajBxupBra5c6XQQyeuyigKQ6fM83ObX0MsYzk88yJn-ZkqE20PCbgFE5Swa6h2lqhgEyOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuGFMHuQvceYx3EmzyvNr_qg2LIhEjM_QU&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataEnroll1011 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=yi1IZIMoJHO-uU5m-CNDDp1KkhjaLAQ0Sh32QzBze9pCVoQwMNqcQs3wOG1CwjFQD2KfBqTiyn820PCbgFE5S3pYNLtlgiBYOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuGFMHuQvceYzcljkj1lSD7WRYpy3HTmGY&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataEnroll1112 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=2P89YSxZLFTJmqqtyY97Jx5Sej9TBYtdzHRtdfBur_2Rd6w11RoNsexYxDVEABs8WBVnn2pJyojr-F270-PivxABJfFdI50iOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuGFMHuQvceYyYZcH_zYkSiiWb3c437_Ja&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataEnroll1213 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=YN8ewZvow0hqyJY7z5VgfqySKvYEJNf80lMCZbuxLLJmaMMgaILKw7Cc7cNaKl2d93_e7HB3Xxzr-F270-Piv7LSaPLuXO0AOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuGFMHuQvceYzOCERfHAfZwOnQX6Wqn8ER&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataEnroll1314 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=YVhldhLY0mWbkSRKe438dsWaXVAtDEfn4cjbVXtbTQBWrKPe1nkj2NKAxsfs-NCcpkat656soHPr-F270-PivxuCh-cNhzlZOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuGFMHuQvceYymFr6CdvQpO5-AiIySUO9v&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataFlow0910 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=4Hx4_r1-leefhRODq2oTqohFc7h_VDi2D5GS52aQGJud1iqa9eK8I5DBqQr0sY-9xTjdFc_VXHTr-F270-Piv4xte0COwCAeOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuzup67gDRLyJMcp_AGqUFxsGD6mYBOprp&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataFlow1011 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=if3lDQkqm8G1ynROVsnSp8fjbJUYsVBLcB0rA7YgvKDNLwySt7OO7fJStbM-betlLQazmfvaJJaDu2A6bPRqmRyxmPU6cKKqOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuzup67gDRLyKxV6J4onZe0YjwM94jswJq&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataFlow1112 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=0lFC96NL7R6A4Vr2TcYk3gJAi96Kz0NO6ip4jyAv6RfPeLlYd3199rgsFL0QZGAZ-9DZX78G43ODu2A6bPRqmRLf9q2UMkmzOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuzup67gDRLyIxfP9tPpRXjNAMOY8IX9PP&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataFlow1213 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=bf4WAAksTpuneg8utqh0StqlQNUTrh3tutaIzeSKpuC5MslfWAn7ImlRR1KwuP1L-32s4UCNig2Du2A6bPRqmRlWvn1VLHtKOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuzup67gDRLyJsuflXzu8zmH4_W4pSZUdy&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");
$jsonDataFlow1314 = file_get_contents("https://script.googleusercontent.com/macros/echo?user_content_key=ZhbF4oq6UoGk3IH6f_honBBw7q1UFa4ty9HLnMxXesU2fLtKGeVHiPe7oWgXPEeC_7da3V2S-tSDu2A6bPRqmVzvg35l2rPrOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHaxCoMjMSmZWLp6XAShvjQj50JtCfh4yP7n1RnEoDeOH7XqmOXgX8RYIyMAhIAtjnF9UDzNXGLr6Tv9WeiDcPrEQ5QaPS7HCIrILvgIvntvuzHIkcb0VqPZ1RFeTitfG-zlL9sD0gBveuzup67gDRLyJtlwAhoYCcgy9N2zw5FsbM&lib=MVcLnEUipyThKZcpmQKyqT_CoSfd4egCX");

?>

var dataEnroll0910 = <?php echo $jsonDataEnroll0910; ?>;
var dataEnroll1011 = <?php echo $jsonDataEnroll1011; ?>;
var dataEnroll1112 = <?php echo $jsonDataEnroll1112; ?>;
var dataEnroll1213 = <?php echo $jsonDataEnroll1213; ?>;
var dataEnroll1314 = <?php echo $jsonDataEnroll1314; ?>;
var dataFlow0910 = <?php echo $jsonDataFlow0910; ?>;
var dataFlow1011 = <?php echo $jsonDataFlow1011; ?>;
var dataFlow1112 = <?php echo $jsonDataFlow1112; ?>;
var dataFlow1213 = <?php echo $jsonDataFlow1213; ?>;
var dataFlow1314 = <?php echo $jsonDataFlow1314; ?>;

var csvData2 = dataFlow1314.flow_13_14;
var csvData = dataEnroll1314.enroll_13_14;
var prevYear1 = dataEnroll1213.enroll_12_13;
var prevYear2 = dataEnroll1112.enroll_11_12;
var prevYear3 = dataEnroll1011.enroll_10_11;
var prevYear4 = dataEnroll0910.enroll_09_10;


updateData();

function updateData() {

// d3.csv(loadData2, function(error, csvData2) {
//     csvData2.forEach(function(d) {
//         d.schyear = d.schyear;
//         d.nbr = +d.nbr;
//         d.to_district = d.to_district;
//         d.from_district = d.from_district;
//         d.count = +d.count;
//     });

// //INITIAL BUBBLES

// d3.csv(data1213, function(error, prevYear1) {
//     prevYear1.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data1112, function(error, prevYear2) {
//     prevYear2.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data1011, function(error, prevYear3) {
//     prevYear3.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data0910, function(error, prevYear4) {
//     prevYear4.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });


// d3.csv(loadData, function(error, csvData) {
//     csvData.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// $('#map1314 svg').remove();
// $('#map1213 svg').remove();

var width = $(".mappage").width(),
    height = $(".mappage").height(),
    centered;

var projection = d3.geo.albersUsa()
    .scale(3000)
    .translate([-500, 970]);

var path = d3.geo.path()
    .projection(projection);

var force = d3.layout.force().size([width, height]);

var svg = d3.select("#map1314 svg")
    .attr("width", width)
    .attr("height", height);

svg.append("rect")
    .attr("class", "background")
    .attr("width", width)
    //.on("click", clicked2)
    .attr("height", height);

g = svg.append("g");

var none = "#f7f7f7";
var q1="#006d2c" //300%
var q2="#31a354" //100%
var q3="#67c25d" //20%
var q4="#a1d99b" //1%
var q5="#d9d9d9" //-1%
var q6="#888888" //-10%
var q7="#4f4f4f" //-20%
var q8="#252525" //-50%

//var q5="#fcae91" //-1%
//var q6="#fb6a4a" //-10%
//var q7="#de2d26" //-20%
//var q8="#a50f15" //-50%



var districtInfo = document.getElementById('infobox');
var graphInfo = document.getElementById('graph');
var node;

d3.json("shapefiles/districts.json", function(error, us) {

var nodes = [], 
    links = [];

us.features.forEach(function(d, i) {
    if (d.id === 2 || d.id === 15 || d.id === 72) return; // lower 48
    var centroid = path.centroid(d);
    if (centroid.some(isNaN)) return;
    centroid.x = centroid[0];
    centroid.y = centroid[1];
    centroid.feature = d;
    nodes.push(centroid);
  });

d3.geom.voronoi().links(nodes).forEach(function(link) {
    var dx = link.source.x - link.target.x,
        dy = link.source.y - link.target.y;
    link.distance = Math.sqrt(dx * dx + dy * dy);
    links.push(link);
  });

force
      .gravity(0.4)
      .nodes(nodes)
      .links(links)
      .linkDistance(20)
      .charge(-170)
      .linkDistance(function(d) { return d.distance; })
      .start();

  var link = svg.selectAll("line")
      .data(links)
    .enter().append("line")
      .attr("x1", function(d) { return d.source.x; })
      .attr("y1", function(d) { return d.source.y; })
      .attr("x2", function(d) { return d.target.x; })
      .attr("y2", function(d) { return d.target.y; });

var radius = d3.scale.sqrt()
    .domain([0, 1e6])
    .range([5, 100]);

  node = svg.selectAll("g")
  .selectAll("circle")
      .data(nodes)
    .enter().append("circle")
      .on("click", clicked_)
      .attr("id", function(d) { var str = d.feature.properties.UNI_NAM; return str.replace(new RegExp(" ", "g"),"-"); })
      .attr("disName", function(d){ return d.feature.properties.UNI_NAM; })
      .attr("class", function(d) { return "bubble n" + d.feature.properties.UNI_MAJ; })
      .attr("in1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.feature.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].in; }}})
      .attr("in2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.feature.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].in; }}})
      .attr("in3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.feature.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].in; }}})
      .attr("in4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.feature.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].in; }}})
      .attr("in5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.feature.properties.UNI_MAJ == csvData[j].index){ return csvData[j].in; }}})
      .attr("out1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.feature.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].out; }}})
      .attr("out2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.feature.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].out; }}})
      .attr("out3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.feature.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].out; }}})
      .attr("out4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.feature.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].out; }}})
      .attr("out5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.feature.properties.UNI_MAJ == csvData[j].index){ return csvData[j].out; }}})
      .attr("pop1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.feature.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].students; }}})
      .attr("pop2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.feature.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].students; }}})
      .attr("pop3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.feature.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].students; }}})
      .attr("pop4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.feature.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].students; }}})
      .attr("pop5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.feature.properties.UNI_MAJ == csvData[j].index){ return csvData[j].students; }}})
      .attr("transform", function(d) { return "translate(" + -d.x + "," + -d.y + ")"; })
      .call(force.drag)      
      .style("fill", "#eee")
      .attr("r", function(d, i){for (var j = 0; j < 513; j++){if (d.feature.properties.UNI_MAJ == csvData[j].index){return radius(csvData[j].students)}}})
      .call(d3.helper.tooltip(
        function(d, i){
        for (var j = 0; j < 513; j++){
        if (d.feature.properties.UNI_MAJ == csvData[j].index){ 
	var blurg = d3.selectAll(".n" + d.feature.properties.UNI_MAJ);
   	var fromGross = Number(blurg.attr("from"));
   	var toGross = Number(blurg.attr("to"));
   	var netFlow = Number(fromGross - toGross);
        //console.log(blurg.attr("id") + " " + netFlow);

	if (netFlow == 0){
		if (csvData[j].percent > 0){ return "<div class='county_header'>" + d.feature.properties.UNI_NAM + "</div><hr class='divide'><div class='pos_change'>+" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(',')(csvData[j].students) + " students</div>"; }
        	else if (csvData[j].percent < 0) { return "<div class='county_header'>" + d.feature.properties.UNI_NAM + "</div><hr class='divide'><div class='neg_change'>" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(',')(csvData[j].students) + " students</div>"; }
        	else { return "<div class='county_header'>" + d.feature.properties.UNI_NAM + "</div><hr class='divide'><div class='change'>" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(csvData[j].students)(',d') + " students</div>"; }
		} 
	else if (netFlow < 0) { return "<div class='county_header'>" + d.feature.properties.UNI_NAM + "</div><hr class='divide'><span class='neg_change'>" + netFlow + "</span><span> net student loss to district</span>"; }   
	else if (netFlow > 0) { return "<div class='county_header'>" + d.feature.properties.UNI_NAM + "</div><hr class='divide'><span class='pos_change'>+" + netFlow + "</span><span> net student gain from district</span>"; }   
	   }

	}
}))
      .style("fill", function(d, i){

        for (var j = 0; j < 513; j++){
          if (d.feature.properties.UNI_MAJ == csvData[j].index){ 
            if (csvData[j].percent >= 300){ return q1; }
            if (csvData[j].percent >= 100){ return q2; }
            if (csvData[j].percent >= 20){ return q3; }
            if (csvData[j].percent > 0){ return q4; }
            if (csvData[j].percent == 0){ return none; }
            if (csvData[j].percent <= -50){ return q8; }
            if (csvData[j].percent <= -20){ return q7; }
            if (csvData[j].percent <= -10){ return q6; }
            if (csvData[j].percent <= 0){ return q5; }
            else { return none; }
}
         }
        })
      .on("mousedown", function(d){
		g.selectAll(".bubble").classed("h1", false);
		g.selectAll(".bubble").classed("h2", false);
		g.selectAll(".bubble").classed("h3", false);
		g.selectAll(".bubble").classed("h4", false);
		g.selectAll(".bubble").classed("h5", false);
		g.selectAll(".bubble").classed("h6", false);
		g.selectAll(".bubble").classed("hn1", false);
		g.selectAll(".bubble").classed("hn2", false);
		g.selectAll(".bubble").classed("hn3", false);
		g.selectAll(".bubble").classed("hn4", false);
		g.selectAll(".bubble").classed("hn5", false);
		g.selectAll(".bubble").classed("hn6", false);
		g.selectAll(".bubble").classed("flow", false);
		g.selectAll(".bubble").attr('to', '0');
		g.selectAll(".bubble").attr('from', '0');

  $( "#migrate" ).show();
  $( "#change" ).hide();
  $( "#graph" ).show();
  $( "#bubble_legend" ).hide();

	for (var j = 0; j < 513; j++){
if (d.feature.properties.UNI_MAJ == csvData[j].index){ 
	for (var k = 0; k < csvData2.length; k++){
	      if (d.feature.properties.UNI_NAM == csvData2[k].to_district){ 
		var fleeing = "#" + csvData2[k].from_district;
		g.selectAll(fleeing.replace(new RegExp(" ", "g"),"-")).attr("from", function(d){ return csvData2[k].count });

           }
	      else if (d.feature.properties.UNI_NAM == csvData2[k].from_district){ 
		var fleeing = "#" + csvData2[k].to_district;
		g.selectAll(fleeing.replace(new RegExp(" ", "g"),"-")).attr("to", function(d){ return csvData2[k].count });

           }
       }

}

		if (d.feature.properties.UNI_MAJ == csvData[j].index){ 
districtInfo.innerHTML = "<h4>Net student migration</h4>";
		}
	}

graphTarget = d3.select(this);
//graphTarget.each(pulse);
var net1 = Number(graphTarget.attr("in1")) - Number(graphTarget.attr("out1"));
var net2 = Number(graphTarget.attr("in2")) - Number(graphTarget.attr("out2"));
var net3 = Number(graphTarget.attr("in3")) - Number(graphTarget.attr("out3"));
var net4 = Number(graphTarget.attr("in4")) - Number(graphTarget.attr("out4"));
var net5 = Number(graphTarget.attr("in5")) - Number(graphTarget.attr("out5"));
var pop1 = Number(graphTarget.attr("pop1"));
var pop2 = Number(graphTarget.attr("pop2"));
var pop3 = Number(graphTarget.attr("pop3"));
var pop4 = Number(graphTarget.attr("pop4"));
var pop5 = Number(graphTarget.attr("pop5"));
var school = graphTarget.attr("id");

oTable.fnFilter(graphTarget.attr("disName") + ' ');
$("td.District-cell").removeClass("clickified");
$("td.District-cell").addClass("clickified");

var districtData = [
  {
    "key": "students migrated",
    "name": school,
    "values": [
      { 
        "label" : "2009-2010" ,
        "value" : net4
      },
      { 
        "label" : "2010-2011" ,
        "value" : net3
      },
      { 
        "label" : "2011-2012" ,
        "value" : net2
      },
      { 
        "label" : "2012-2013" ,
        "value" : net1
      },
      { 
        "label" : "2013-2014" ,
        "value" : net5
      }
    ]
  }
]

redrawChart(districtData);

d3.selectAll(".bubble").each(function(d,i){
    var elt = d3.select(this);
    var fromGross = Number(elt.attr("from"));
    var toGross = Number(elt.attr("to"));
    var netFlow = fromGross - toGross;
		if (netFlow >= 400) { elt.classed("h6 flow", true);  }
		else if (netFlow >= 300) { elt.classed("h5 flow", true); }
		else if (netFlow >= 200) { elt.classed("h4 flow", true); }
		else if (netFlow >= 100) { elt.classed("h3 flow", true); }
		else if (netFlow > 0) { elt.classed("h2 flow", true); }
		else if (netFlow <= -400) { elt.classed("hn6 flow", true);  }
		else if (netFlow <= -300) { elt.classed("hn5 flow", true); }
		else if (netFlow <= -200) { elt.classed("hn4 flow", true); }
		else if (netFlow <= -100) { elt.classed("hn3 flow", true); }
		else if (netFlow < 0) { elt.classed("hn2 flow", true); }

});

})
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
      .attr("d", function(d) { return path(d.feature); });

  force.on("tick", function(e) {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) {
      return "translate(" + d.x + "," + d.y + ")";
    });
  });

$( "#cartage" ).click(function() {
  force.start();
  }); 


});

// zoom and pan
var zoom = d3.behavior.zoom()
    .on("zoom",function() {
        g.attr("transform","translate("+ 
            d3.event.translate.join(",")+")scale("+d3.event.scale+")");
        g.selectAll("circle")
            .attr("d", path.projection(projection));
        g.selectAll("path")  
            .attr("d", path.projection(projection)); 

  });

svg.call(zoom);

$("#zoom").click(function() {
  clicked2_();
  $("td.District-cell").removeClass("clickified");
  oTable.fnFilter('');
  $( "#migrate" ).hide();
  $( "#change" ).show();
  $( "#graph" ).hide();
  $( "#bubble_legend" ).show();

});
$(".myButton").click(function() {
  clicked2_();
});
$("#mappage").click(function() {
  clicked2_();
});
$("#cartage").click(function() {
  clicked2_();
});

function pulse() {
			var circle = svg.select("circle");
			(function repeat() {
				circle = circle.transition()
					.duration(2000)
					.attr("stroke-width", 20)
					.attr("r", 10)
					.transition()
					.duration(2000)
					.attr('stroke-width', 0.5)
					.attr("r", 200)
					.ease('sine')
					.each("end", repeat);
			})();
		}

function clicked_(d) {
  var x, y, k;

  if (d && centered !== d) {
    x = d.x;
    y = d.y;
    k = 1.5;
    centered = d;
  } else {
    x = width / 2;
    y = height / 2;
    k = 3;
    centered = null;
  }


  g.selectAll("circle")
      .classed("faded", true)
      .classed("clicked", centered && function(d) { return d === centered; });
   

  g.transition()
      .duration(750)
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
      .style("stroke-width", 1.5 / k + "px");

}

function clicked2_(d) {
  var x, y, k;
var districtInfo = document.getElementById('infobox');
districtInfo.innerHTML = "";

  if (d && centered !== d) {
    var centroid = path.centroid(d);
    x = centroid[0];
    y = centroid[1];
    k = 4;
    centered = d;
  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }

		g.selectAll(".bubble").classed("h1", false);
		g.selectAll(".bubble").classed("h2", false);
		g.selectAll(".bubble").classed("h3", false);
		g.selectAll(".bubble").classed("h4", false);
		g.selectAll(".bubble").classed("h5", false);
		g.selectAll(".bubble").classed("h6", false);
		g.selectAll(".bubble").classed("hn1", false);
		g.selectAll(".bubble").classed("hn2", false);
		g.selectAll(".bubble").classed("hn3", false);
		g.selectAll(".bubble").classed("hn4", false);
		g.selectAll(".bubble").classed("hn5", false);
		g.selectAll(".bubble").classed("hn6", false);
		g.selectAll(".bubble").attr('to', '0');
		g.selectAll(".bubble").attr('from', '0');
		g.selectAll("path").classed("h1", false);
		g.selectAll("path").classed("h2", false);
		g.selectAll("path").classed("h3", false);
		g.selectAll("path").classed("h4", false);
		g.selectAll("path").classed("h5", false);
		g.selectAll("path").classed("hn1", false);
		g.selectAll("path").classed("hn2", false);
		g.selectAll("path").classed("hn3", false);
		g.selectAll("path").classed("hn4", false);
		g.selectAll("path").classed("hn5", false);
		g.selectAll("path").attr('to', '0');
		g.selectAll("path").attr('from', '0');

  g.selectAll("circle")
      .classed("faded", false)
      .classed("clicked", centered && function(d) { return d === centered; });

  g.transition()
      .duration(750)
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
      .style("stroke-width", 1.5 / k + "px");
}

// });

//     });

//     });

//     });

//     });

//2012-2013 year
// d3.csv(data1213, function(error, prevYear1) {
//     prevYear1.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data1112, function(error, prevYear2) {
//     prevYear2.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data1011, function(error, prevYear3) {
//     prevYear3.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(data0910, function(error, prevYear4) {
//     prevYear4.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         //d.percent = +d.pctgrowth;
//         d.percent = parseFloat(d.pctgrowth);
//         d.index = +d.districtNumber;
//     });

// d3.csv(loadData, function(error, csvData) {
//     csvData.forEach(function(d) {
//         d.name = d.DistrictName;
//         d.year = d.DataYear;
//         d.students = +d.TotalStudents;
//         d.in = +d.TransferIn;
//         d.out = +d.TransferOut;
//         d.estBase = +d.estBase;
//         d.percent = +d.pctgrowth;
//         d.index = +d.districtNumber;
//     });

var width = $(".mappage").width(),
    height = $(".mappage").height(),
    centered;

var projection2 = d3.geo.albersUsa()
    .scale(6570)
    .translate([75, 1270]);

var path2 = d3.geo.path()
    .projection(projection2);

var svg2 = d3.select("#map1213 svg")
    .attr("width", width)
    .attr("height", height);

svg2.append("rect")
    .attr("class", "background")
    .attr("width", width)
    //.on("click", clicked2)
    .attr("height", height);

var g2 = svg2.append("g");

var none = "#f7f7f7";
var q1="#006d2c" //300%
var q2="#31a354" //100%
var q3="#67c25d" //20%
var q4="#a1d99b" //1%
var q5="#d9d9d9" //-1%
var q6="#888888" //-10%
var q7="#4f4f4f" //-20%
var q8="#252525" //-50%

var districtInfo = document.getElementById('infobox');
var graphInfo = document.getElementById('graph');

d3.json("shapefiles/districts.json", function(error, us) {
  g2.append("g")
      .attr("id", "states")
    .selectAll("path")
      .data(us.features)
    .enter().append("path")
      .on("click", clicked)
      .attr("d", path2)
      .attr("class", function(d){ return "n" + d.properties.UNI_MAJ + "_m"; })
      .attr("id", function(d) { var str = d.properties.UNI_NAM + "_m"; return str.replace(new RegExp(" ", "g"),"-"); })
      .attr("disName", function(d){ return d.properties.UNI_NAM; })
      .attr("in1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].in; }}})
      .attr("in2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].in; }}})
      .attr("in3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].in; }}})
      .attr("in4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].in; }}})
      .attr("in5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.properties.UNI_MAJ == csvData[j].index){ return csvData[j].in; }}})
      .attr("out1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].out; }}})
      .attr("out2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].out; }}})
      .attr("out3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].out; }}})
      .attr("out4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].out; }}})
      .attr("out5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.properties.UNI_MAJ == csvData[j].index){ return csvData[j].out; }}})
      .attr("pop1", function(d) { for (var j = 0; j < prevYear1.length; j++){if (d.properties.UNI_MAJ == prevYear1[j].index){ return prevYear1[j].students; }}})
      .attr("pop2", function(d) { for (var j = 0; j < prevYear2.length; j++){if (d.properties.UNI_MAJ == prevYear2[j].index){ return prevYear2[j].students; }}})
      .attr("pop3", function(d) { for (var j = 0; j < prevYear3.length; j++){if (d.properties.UNI_MAJ == prevYear3[j].index){ return prevYear3[j].students; }}})
      .attr("pop4", function(d) { for (var j = 0; j < prevYear4.length; j++){if (d.properties.UNI_MAJ == prevYear4[j].index){ return prevYear4[j].students; }}})
      .attr("pop5", function(d) { for (var j = 0; j < csvData.length; j++){if (d.properties.UNI_MAJ == csvData[j].index){ return csvData[j].students; }}})
      .on("mousedown", function(d){
		g2.selectAll("path").classed("h1", false);
		g2.selectAll("path").classed("h2", false);
		g2.selectAll("path").classed("h3", false);
		g2.selectAll("path").classed("h4", false);
		g2.selectAll("path").classed("h5", false);
		g2.selectAll("path").classed("h6", false);
		g2.selectAll("path").classed("hn1", false);
		g2.selectAll("path").classed("hn2", false);
		g2.selectAll("path").classed("hn3", false);
		g2.selectAll("path").classed("hn4", false);
		g2.selectAll("path").classed("hn5", false);
		g2.selectAll("path").classed("hn6", false);
		g2.selectAll("path").classed("flow", false);
		g2.selectAll("path").attr('to', '0');
		g2.selectAll("path").attr('from', '0');

  $( "#migrate" ).show();
  $( "#change" ).hide();
  $( "#graph" ).show();
  $( "#bubble_legend" ).hide();

	for (var j = 0; j < 513; j++){
if (d.properties.UNI_MAJ == csvData[j].index){ 
	for (var k = 0; k < csvData2.length; k++){
	      if (d.properties.UNI_NAM == csvData2[k].to_district){ 
		var fleeing = "#" + csvData2[k].from_district + "_m";
		g2.selectAll(fleeing.replace(new RegExp(" ", "g"),"-")).attr("from", function(d){ return csvData2[k].count });

           }
	      else if (d.properties.UNI_NAM == csvData2[k].from_district){ 
		var fleeing = "#" + csvData2[k].to_district + "_m";
		g2.selectAll(fleeing.replace(new RegExp(" ", "g"),"-")).attr("to", function(d){ return csvData2[k].count });

           }
       }

}
		if (d.properties.UNI_MAJ == csvData[j].index){ 
	districtInfo.innerHTML = "<h4>Net student migration</h4>";
		}
	}

graphTarget = d3.select(this);
var net1 = Number(graphTarget.attr("in1")) - Number(graphTarget.attr("out1"));
var net2 = Number(graphTarget.attr("in2")) - Number(graphTarget.attr("out2"));
var net3 = Number(graphTarget.attr("in3")) - Number(graphTarget.attr("out3"));
var net4 = Number(graphTarget.attr("in4")) - Number(graphTarget.attr("out4"));
var net5 = Number(graphTarget.attr("in5")) - Number(graphTarget.attr("out5"));
var pop1 = Number(graphTarget.attr("pop1"));
var pop2 = Number(graphTarget.attr("pop2"));
var pop3 = Number(graphTarget.attr("pop3"));
var pop4 = Number(graphTarget.attr("pop4"));
var pop5 = Number(graphTarget.attr("pop5"));
var school = graphTarget.attr("id");

oTable.fnFilter(graphTarget.attr("disName") + ' ');
$("td.District-cell").removeClass("clickified");
$("td.District-cell").addClass("clickified");

var districtData2 = [
  {
    "key": "students migrated",
    "name": school,
    "values": [
      { 
        "label" : "2009-2010" ,
        "value" : net4
      },
      { 
        "label" : "2010-2011" ,
        "value" : net3
      },
      { 
        "label" : "2011-2012" ,
        "value" : net2
      },
      { 
        "label" : "2012-2013" ,
        "value" : net1
      },
      { 
        "label" : "2013-2014" ,
        "value" : net5
      }
    ]
  }
]

redrawChart(districtData2);

d3.selectAll("path").each(function(d,i){
    var elt = d3.select(this);
    var fromGross = Number(elt.attr("from"));
    var toGross = Number(elt.attr("to"));
    var netFlow = fromGross - toGross;
		if (netFlow >= 400) { elt.classed("h6 flow", true);  }
		else if (netFlow >= 300) { elt.classed("h5 flow", true); }
		else if (netFlow >= 200) { elt.classed("h4 flow", true); }
		else if (netFlow >= 100) { elt.classed("h3 flow", true); }
		else if (netFlow > 0) { elt.classed("h2 flow", true); }
		else if (netFlow <= -400) { elt.classed("hn6 flow", true);  }
		else if (netFlow <= -300) { elt.classed("hn5 flow", true); }
		else if (netFlow <= -200) { elt.classed("hn4 flow", true); }
		else if (netFlow <= -100) { elt.classed("hn3 flow", true); }
		else if (netFlow < 0) { elt.classed("hn2 flow", true); }

});

})
      .on("click", clicked)
      .style("stroke-width", "1px")
      .style("stroke", "#fff")
      .style("fill", function(d, i){

        for (var j = 0; j < 513; j++){
          if (d.properties.UNI_MAJ == csvData[j].index){ 
            if (csvData[j].percent >= 300){ return q1; }
            if (csvData[j].percent >= 100){ return q2; }
            if (csvData[j].percent >= 20){ return q3; }
            if (csvData[j].percent > 0){ return q4; }
            if (csvData[j].percent == 0){ return none; }
            if (csvData[j].percent <= -50){ return q8; }
            if (csvData[j].percent <= -20){ return q7; }
            if (csvData[j].percent <= -10){ return q6; }
            if (csvData[j].percent <= 0){ return q5; }
            else { return none; }
}
         }
        })

      .call(d3.helper.tooltip(
        function(d, i){
        for (var j = 0; j < 513; j++){
        if (d.properties.UNI_MAJ == csvData[j].index){ 
	var blurg = d3.selectAll(".n" + d.properties.UNI_MAJ + "_m");
   	var fromGross = Number(blurg.attr("from"));
   	var toGross = Number(blurg.attr("to"));
   	var netFlow = Number(fromGross - toGross);
        //console.log(blurg.attr("id") + " " + netFlow);

	if (netFlow == 0){
		if (csvData[j].percent > 0){ return "<div class='county_header'>" + d.properties.UNI_NAM + "</div><hr class='divide'><div class='pos_change'>+" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(',')(csvData[j].students) + " students</div>"; }
        	else if (csvData[j].percent < 0) { return "<div class='county_header'>" + d.properties.UNI_NAM + "</div><hr class='divide'><div class='neg_change'>" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(',')(csvData[j].students) + " students</div>"; }
        	else { return "<div class='county_header'>" + d.properties.UNI_NAM + "</div><hr class='divide'><div class='change'>" + csvData[j].percent + "% growth</div><div class='students'>" + d3.format(csvData[j].students)(',d') + " students</div>"; }
		} 
	else if (netFlow < 0) { return "<div class='county_header'>" + d.properties.UNI_NAM + "</div><hr class='divide'><span class='neg_change'>" + netFlow + "</span><span> net student loss to district</span>"; }   
	else if (netFlow > 0) { return "<div class='county_header'>" + d.properties.UNI_NAM + "</div><hr class='divide'><span class='pos_change'>+" + netFlow + "</span><span> net student gain from district</span>"; }   
	   }

	}
}));

  g2.append("path")
      //.datum(topojson.mesh(us, us.features, function(a, b) { return a !== b; }))
      .attr("id", "state-borders")
      .attr("d", path);
});

// zoom and pan
var zoom2 = d3.behavior.zoom()
    .on("zoom",function() {
        g2.attr("transform","translate("+ 
            d3.event.translate.join(",")+")scale("+d3.event.scale+")");
        g2.selectAll("circle")
            .attr("d", path.projection(projection));
        g2.selectAll("path")  
            .attr("d", path.projection(projection)); 

  });

// svg2.call(zoom2);

$("#zoom").click(function() {
  clicked2();
    $("td.District-cell").removeClass("clickified");
});
$(".myButton").click(function() {
  clicked2();
});

function clicked(d) {
  var x, y, k;

  if (d && centered !== d) {
    var centroid = path.centroid(d);
    x = centroid[0];
    y = centroid[1];
    k = 4;
    centered = d;
  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }

  g2.selectAll("path")
      .classed("faded2", true)
      .classed("active", centered && function(d) { return d === centered; });

  // g2.transition()
  //     .duration(750)
  //     .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
  //     .style("stroke-width", 1.5 / k + "px");
}

function clicked2(d) {
  var x, y, k;
var districtInfo = document.getElementById('infobox');
districtInfo.innerHTML = "";

		g2.selectAll(".bubble").classed("h1", false);
		g2.selectAll(".bubble").classed("h2", false);
		g2.selectAll(".bubble").classed("h3", false);
		g2.selectAll(".bubble").classed("h4", false);
		g2.selectAll(".bubble").classed("h5", false);
		g2.selectAll(".bubble").classed("h6", false);
		g2.selectAll(".bubble").classed("hn1", false);
		g2.selectAll(".bubble").classed("hn2", false);
		g2.selectAll(".bubble").classed("hn3", false);
		g2.selectAll(".bubble").classed("hn4", false);
		g2.selectAll(".bubble").classed("hn5", false);
		g2.selectAll(".bubble").classed("hn6", false);
		g2.selectAll(".bubble").attr('to', '0');
		g2.selectAll(".bubble").attr('from', '0');
		g2.selectAll("path").classed("h1", false);
		g2.selectAll("path").classed("h2", false);
		g2.selectAll("path").classed("h3", false);
		g2.selectAll("path").classed("h4", false);
		g2.selectAll("path").classed("h5", false);
		g2.selectAll("path").classed("h6", false);
		g2.selectAll("path").classed("hn1", false);
		g2.selectAll("path").classed("hn2", false);
		g2.selectAll("path").classed("hn3", false);
		g2.selectAll("path").classed("hn4", false);
		g2.selectAll("path").classed("hn5", false);
		g2.selectAll("path").classed("hn6", false);
		g2.selectAll("path").attr('to', '0');
		g2.selectAll("path").attr('from', '0');


  if (d && centered !== d) {
    var centroid = path.centroid(d);
    x = centroid[0];
    y = centroid[1];
    k = 4;
    centered = d;
  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }

  g2.selectAll("path")
      .classed("faded2", false)
      .classed("active", centered && function(d) { return d === centered; });

  g2.transition()
      .duration(750)
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
      .style("stroke-width", 1.5 / k + "px");

}

// });

// });

//     });

//     });

//     });

//     });


d3.helper = {};

d3.helper.tooltip = function(accessor){
    return function(selection){
        var tooltipDiv;
        var bodyNode = d3.select('body').node();
        selection.on("mouseover", function(d, i){
            // Clean up lost tooltips
            d3.select('body').selectAll('div.tooltip').remove();
            // Append tooltip
            tooltipDiv = d3.select('body').append('div').attr('class', 'tooltip');
            var absoluteMousePos = d3.mouse(bodyNode);
            tooltipDiv.style('left', (absoluteMousePos[0] + 10)+'px')
                .style('top', (absoluteMousePos[1] - 15)+'px')
                .style('position', 'absolute') 
                .style('z-index', 1001);
            // Add text using the accessor function
            var tooltipText = accessor(d, i) || '';
            // Crop text arbitrarily
            //tooltipDiv.style('width', function(d, i){return (tooltipText.length > 80) ? '300px' : null;})
            //    .html(tooltipText);
        })
        .on('mousemove', function(d, i) {
            // Move tooltip
            var absoluteMousePos = d3.mouse(bodyNode);
            tooltipDiv.style('left', (absoluteMousePos[0] + 10)+'px')
                .style('top', (absoluteMousePos[1] - 15)+'px');
            var tooltipText = accessor(d, i) || '';
            tooltipDiv.html(tooltipText);
        })
        .on("mouseout", function(d, i){
            // Remove tooltip
            tooltipDiv.remove();
        });

    };
};

console.log(csvData.length);

 }
</script>

</html>