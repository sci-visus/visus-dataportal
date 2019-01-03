<!DOCTYPE html>
<script>
/*
 * Copyright (c) 2017 University of Utah 
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of the copyright holder nor the names of its
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
</script>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>ViSUS WebViewer</title>
        
     <link rel="stylesheet" href="../ext/bootstrap-3.3.7/css/bootstrap.min.css">
    <script src="../ext/bootstrap-3.3.7/jquery/jquery.min.js"></script>
    <script src="../ext/bootstrap-3.3.7/js/bootstrap.min.js"></script>

</head>

<style type="text/css">
  .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00557F; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>

<body>
<div id="nav-placeholder"></div>

<script>
$(function(){
  $("#nav-placeholder").load("../navbar.php", function(){ 
     $("img[src='site_logo.gif']").attr('src', '../site_logo.gif');
     $("a[href='datasets.php']").attr('href', '../datasets.php');
     $("a[href='index.php']").attr('href', '../index.php');
     $("a[href='viewer']").attr('href', '../viewer');
     $("a[href='logout.php']").attr('href', '../logout.php');
  } );
});
</script>

  <div id="viewer">
    <div>
      <table cellspacing="0" cellpadding="0" style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;'>
        <tr>
          <td align="center" class="datagrid" height="18px">
            <div id='status_bar' style="float:top" hidden><img src="../ext/visus/img/spinner.gif" height="10px" ><label id='status' style="color: blue"></label></div>
          </td>
        </tr>
        <tr style='height:100%;width:100%'>
          <td align="center">
            <div id='2dCanvas' style='width:100%; height:100%;'></div>
            <canvas id='3dCanvas' width='1000px' height='600px'></canvas>
          </td>
        </tr>
        <tr id='row_link' hidden><td><input id='link_text' style='width:100%' /> <input type='button' value='Copy' onclick='onCopy()'/></td></tr>
        <tr>
          <td>
            <div class="datagrid">
              <table width='100%'>
                <tr>
                  <td> <label>Server</label> <input id='server' size=32 onchange='setServer(this.value);' class='toolbar_value'/>
                  <td> <label>Render</label> 
                    <select id='render_type' onchange='onVRChange(this.value);' class='toolbar_value'>
                      <option value="0">Slice</option>
                      <option value="1">Volume</option>
                      <option value="2">Iso Contour</option>
                    </select>
                  <td> <label>Dataset</label> <select id='dataset' onchange='setDataset(this.value);' class='toolbar_value' />
                  <td><label>Field</label> <select id='field' onchange='onFieldChange(this.value);' class='toolbar_value' /> 
                  <td><input id='auto_refresh' type='checkbox' size=32 onchange='onRefreshChange(this.value);' class='toolbar_value'>auto</input> <input type='button' value='Refresh' onclick="refreshAll(0)"/> </td>
                  <td id='range_panel'><label>Range</label> <label id="comp_range"> [...] </label>
                  <td id='resolution_panel'><label>Resolution</label><input  id='resolution' type='range' step='1' min='0' step='1' max='33' style='width:100%' oninput='onResolutionChange(this.value);'/> 
                  <td id='edit_resolution_panel'><div><input id='edit_resolution' size=2 onchange='onResolutionChange(this.value);' class='toolbar_value'/><label id="size_est"> ... KB </label></div>
                  <td><div><input id='view_btn' type='button' value='View' onclick='onViewResolution()'/> <input type='button' id='download_btn' value='Download' onclick='download()'/> <input type='button' value='Share' onclick='shareLink()'/></div>
                </tr>
              </table>
            </div>
          </td>   
        </tr>    
        <tr>
          <td>
            <div class="datagrid">
              <table width='100%' >
                <tr>
                  <td><label id="axis_label">Axis</label>
                  <td>
                    <select id='axis' onchange='onAxisChange(this.value);' class='toolbar_value'>
                      <option value='2'>Z</option>
                      <option value='1'>Y</option>
                      <option value='0'>X</option>
                    </select>
                    
                  <td><label id='render_slider_lbl'>Slice</label>
                  <td width='50%'>
                    <table width='100%'>
                      <tr width='100%'>
                        <td width='100%'>
                          <input id='slice' type='range' min='0' step='1' max='100' style='width:100%' oninput='onSliceChange(this.value);'/>
                        <td>
                          <input id='edit_slice' size=2 onchange='onSliceChange(this.value);' class='toolbar_value'>
                      </tr>
                    </table>
                    
                  <td><label>Time</label>       
                  <td width='50%'>
                    <table width='100%'>
                      <tr width='100%'>            
                        <td width='100%'><input  id='time' type='range' step='1' style='width:100%' oninput='onTimeChange(this.value);'>
                        <td><input id='edit_time' size=2 onchange='onTimeChange(this.value);' class='toolbar_value'>
                      </tr>
                    </table>                  
                    
                  <td><label>Palette</label>     
                  <td>
                    <select id='palette' onchange='onPaletteChange();' class='toolbar_value'>
                      <option value=''></option>
                      <option value='rich' selected="selected">rich</option>
                      <option value='hsl'>hsl</option>
                      <option value='banded'>banded</option>
                      <option value='bry'>bry</option>
                      <option value='bgry'>bgry</option> 
                      <option value='gamma'>gamma</option>
                      <option value='hot1'>hot1</option>
                      <option value='hot2'>hot2</option>
                      <option value='ice'>ice</option>
                      <option value='lighthues'>lighthues</option> 
                      <option value='smoothrich'>smoothrich</option>
                      <option value='lut16'>lut16</option>
                      <option value='BlueGreenDivergent'>BlueGreenDivergent</option>
                      <option value='AsymmetricBlueGreenDivergent'>AsymmetricBlueGreenDivergent</option> 
                      <option value='GreenGold'>GreenGold</option>
                      <option value='LinearGreen'>LinearGreen</option>
                      <option value='LinearTurquois'>LinearTurquois</option>
                      <option value='MutedBlueGreen'>MutedBlueGreen</option>
                      <option value='ExtendedCoolWarm'>ExtendedCoolWarm</option>
                      <option value='AsymmetricBlueOrangeDivergent'>AsymmetricBlueOrangeDivergent</option>
                      <option value='LinearYellow'>LinearYellow</option>
                      <option value='LinearGray5'>LinearGray5</option>
                      <option value='LinearGray4'>LinearGray4</option>  
                      <option value='grayopaque'>grayopaque</option>
                      <option value='graytransparent'>graytransparent</option> 
                      <option value='scivis_magic_colormap'>magic color map</option>
                    </select>
                    
                  <td><label>Min</label>
                  <td><input id='palette_min' size=2 onchange='onPaletteChange();' class='toolbar_value'>
                    
                  <td><label>Max</label> 
                  <td><input id='palette_max' size=2 onchange='onPaletteChange();' class='toolbar_value'>
                    
                    <!-- <td><label>Interpolation</label>    
                         <td>
                           <select id='palette_interp' onchange='onPaletteChange();' class='toolbar_value'>
                             <option value='Default'>Default</option>
                             <option value='Flat'>Flat</option>
                             <option value='Inverted'>Inverted</option>
                           </select>  -->
                </tr>
              </table>
            </div>
          </td>
        </tr>
        
        <table>
          <!-- 
               <label>Resolution:<input id="resolution_select" type="range" step="1"></label>
               <button>Submit</button>
               <label>Isovalue:<input id="isovalue_select" type="range" step="0.01"></label> -->
          <!-- <a onclick="vr_present()">VR</a> -->
        </table>
      </table>
    </div>
  </div>

  <!-- <details ontoggle="load_dataset(this, &#39;aneurism&#39;, {level: 24, width: 256, height: 256, depth: 256}, &#39;uint8&#39;, {width: 256.0, height: 256.0, depth: 256.0})"/> -->

  <script src='https://openseadragon.github.io/openseadragon/openseadragon.min.js'></script>
  <script src="../ext/visus/src/colormaps.js"></script>
  <script src="../ext/visus/src/dvr.js"></script>
  <script src="../ext/visus/src/visus.js"></script>
  <script src="../viewer/config.js"></script>
  <script src="../ext/visus/src/viewer.js"></script>
  
</body>
</html>
