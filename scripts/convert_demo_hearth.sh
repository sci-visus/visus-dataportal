#!/bin/bash 

# Usage: conver_demo_hearth.sh visus_exe data_dir input_file dim dtype 
#echo $1 $2 $3 $4 $5  

export CONVERT=$1  
$CONVERT create "$2/$3.idx" --box "$4" --fields "data $5" --time 0 0 time%05d/ 
$CONVERT import $2/00003.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 0 0" \
$CONVERT import $2/00004.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 1 1" \
$CONVERT import $2/00005.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 2 2" \
$CONVERT import $2/00006.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 3 3" \
$CONVERT import $2/00007.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 4 4" \
$CONVERT import $2/00008.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 5 5" \
$CONVERT import $2/00009.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 6 6" \
$CONVERT import $2/00010.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 7 7" \
$CONVERT import $2/00011.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 8 8" \
$CONVERT import $2/00012.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 9 9" \
$CONVERT import $2/00013.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 10 10" \
$CONVERT import $2/00014.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 11 11" \
$CONVERT import $2/00015.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 12 12" \
$CONVERT import $2/00016.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 13 13" \
$CONVERT import $2/00017.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 14 14" \
$CONVERT import $2/00018.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 15 15" \
$CONVERT import $2/00019.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 16 16" \
$CONVERT import $2/00020.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 17 17" \
$CONVERT import $2/00021.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 18 18" \
$CONVERT import $2/00022.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 19 19" \
$CONVERT import $2/00023.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 20 20" \
$CONVERT import $2/00024.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 21 21" \
$CONVERT import $2/00025.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 22 22" \
$CONVERT import $2/00026.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 23 23" \
$CONVERT import $2/00027.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 24 24" \
$CONVERT import $2/00028.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 25 25" \
$CONVERT import $2/00029.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 26 26" \
$CONVERT import $2/00030.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 27 27" \
$CONVERT import $2/00031.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 28 28" \
$CONVERT import $2/00032.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 29 29" \
$CONVERT import $2/00033.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 30 30" \
$CONVERT import $2/00034.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 31 31" \
$CONVERT import $2/00035.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 32 32" \
$CONVERT import $2/00036.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 33 33" \
$CONVERT import $2/00037.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 34 34" \
$CONVERT import $2/00038.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 35 35" \
$CONVERT import $2/00039.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 36 36" \
$CONVERT import $2/00040.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 37 37" \
$CONVERT import $2/00041.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 38 38" \
$CONVERT import $2/00042.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 39 39" \
$CONVERT import $2/00043.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 40 40" \
$CONVERT import $2/00044.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 41 41" \
$CONVERT import $2/00045.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 42 42" \
$CONVERT import $2/00046.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 43 43" \
$CONVERT import $2/00047.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 44 44" \
$CONVERT import $2/00048.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 45 45" \
$CONVERT import $2/00049.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 46 46" \
$CONVERT import $2/00050.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 47 47" \
$CONVERT import $2/00051.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 48 48" \
$CONVERT import $2/00052.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 49 49" \
$CONVERT import $2/00053.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 50 50" \
$CONVERT import $2/00054.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 51 51" \
$CONVERT import $2/00055.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 52 52" \
$CONVERT import $2/00056.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 53 53" \
$CONVERT import $2/00057.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 54 54" \
$CONVERT import $2/00058.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 55 55" \
$CONVERT import $2/00059.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 56 56" \
$CONVERT import $2/00060.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 57 57" \
$CONVERT import $2/00061.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 58 58" \
$CONVERT import $2/00062.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 59 59" \
$CONVERT import $2/00063.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 60 60" \
$CONVERT import $2/00064.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 61 61" \
$CONVERT import $2/00065.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 62 62" \
$CONVERT import $2/00066.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 63 63" \
$CONVERT import $2/00067.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 64 64" \
$CONVERT import $2/00068.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 65 65" \
$CONVERT import $2/00069.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 66 66" \
$CONVERT import $2/00070.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 67 67" \
$CONVERT import $2/00071.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 68 68" \
$CONVERT import $2/00072.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 69 69" \
$CONVERT import $2/00073.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 70 70" \
$CONVERT import $2/00074.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 71 71" \
$CONVERT import $2/00075.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 72 72" \
$CONVERT import $2/00076.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 73 73" \
$CONVERT import $2/00077.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 74 74" \
$CONVERT import $2/00078.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 75 75" \
$CONVERT import $2/00079.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 76 76" \
$CONVERT import $2/00080.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 77 77" \
$CONVERT import $2/00081.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 78 78" \
$CONVERT import $2/00082.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 79 79" \
$CONVERT import $2/00083.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 80 80" \
$CONVERT import $2/00084.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 81 81" \
$CONVERT import $2/00085.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 82 82" \
$CONVERT import $2/00086.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 83 83" \
$CONVERT import $2/00087.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 84 84" \
$CONVERT import $2/00088.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 85 85" \
$CONVERT import $2/00089.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 86 86" \
$CONVERT import $2/00090.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 87 87" \
$CONVERT import $2/00091.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 88 88" \
$CONVERT import $2/00092.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 89 89" \
$CONVERT import $2/00093.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 90 90" \
$CONVERT import $2/00094.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 91 91" \
$CONVERT import $2/00095.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 92 92" \
$CONVERT import $2/00096.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 93 93" \
$CONVERT import $2/00097.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 94 94" \
$CONVERT import $2/00098.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 95 95" \
$CONVERT import $2/00099.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 96 96" \
$CONVERT import $2/00100.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 97 97" \
$CONVERT import $2/00101.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 98 98" \
$CONVERT import $2/00102.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 99 99" \
$CONVERT import $2/00103.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 100 100" \
$CONVERT import $2/00104.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 101 101" \
$CONVERT import $2/00105.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 102 102" \
$CONVERT import $2/00106.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 103 103" \
$CONVERT import $2/00107.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 104 104" \
$CONVERT import $2/00108.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 105 105" \
$CONVERT import $2/00109.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 106 106" \
$CONVERT import $2/00110.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 107 107" \
$CONVERT import $2/00111.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 108 108" \
$CONVERT import $2/00112.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 109 109" \
$CONVERT import $2/00113.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 110 110" \
$CONVERT import $2/00114.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 111 111" \
$CONVERT import $2/00115.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 112 112" \
$CONVERT import $2/00116.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 113 113" \
$CONVERT import $2/00117.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 114 114" \
$CONVERT import $2/00118.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 115 115" \
$CONVERT import $2/00119.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 116 116" \
$CONVERT import $2/00120.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 117 117" \
$CONVERT import $2/00121.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 118 118" \
$CONVERT import $2/00122.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 119 119" \
$CONVERT import $2/00123.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 120 120" \
$CONVERT import $2/00124.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 121 121" \
$CONVERT import $2/00125.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 122 122" \
$CONVERT import $2/00126.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 123 123" \
$CONVERT import $2/00127.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 124 124" \
$CONVERT import $2/00128.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 125 125" \
$CONVERT import $2/00129.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 126 126" \
$CONVERT import $2/00130.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 127 127" \
$CONVERT import $2/00131.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 128 128" \
$CONVERT import $2/00132.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 129 129" \
$CONVERT import $2/00133.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 130 130" \
$CONVERT import $2/00134.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 131 131" \
$CONVERT import $2/00135.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 132 132" \
$CONVERT import $2/00136.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 133 133" \
$CONVERT import $2/00137.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 134 134" \
$CONVERT import $2/00138.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 135 135" \
$CONVERT import $2/00139.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 136 136" \
$CONVERT import $2/00140.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 137 137" \
$CONVERT import $2/00141.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 138 138" \
$CONVERT import $2/00142.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 139 139" \
$CONVERT import $2/00143.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 140 140" \
$CONVERT import $2/00144.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 141 141" \
$CONVERT import $2/00145.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 142 142" \
$CONVERT import $2/00146.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 143 143" \
$CONVERT import $2/00147.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 144 144" \
$CONVERT import $2/00148.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 145 145" \
$CONVERT import $2/00149.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 146 146" \
$CONVERT import $2/00150.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 147 147" \
$CONVERT import $2/00151.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 148 148" \
$CONVERT import $2/00152.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 149 149" \
$CONVERT import $2/00153.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 150 150" \
$CONVERT import $2/00154.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 151 151" \
$CONVERT import $2/00155.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 152 152" \
$CONVERT import $2/00156.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 153 153" \
$CONVERT import $2/00157.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 154 154" \
$CONVERT import $2/00158.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 155 155" \
$CONVERT import $2/00159.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 156 156" \
$CONVERT import $2/00160.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 157 157" \
$CONVERT import $2/00161.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 158 158" \
$CONVERT import $2/00162.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 159 159" \
$CONVERT import $2/00163.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 160 160" \
$CONVERT import $2/00164.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 161 161" \
$CONVERT import $2/00165.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 162 162" \
$CONVERT import $2/00166.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 163 163" \
$CONVERT import $2/00167.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 164 164" \
$CONVERT import $2/00168.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 165 165" \
$CONVERT import $2/00169.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 166 166" \
$CONVERT import $2/00170.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 167 167" \
$CONVERT import $2/00171.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 168 168" \
$CONVERT import $2/00172.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 169 169" \
$CONVERT import $2/00173.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 170 170" \
$CONVERT import $2/00174.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 171 171" \
$CONVERT import $2/00175.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 172 172" \
$CONVERT import $2/00176.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 173 173" \
$CONVERT import $2/00177.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 174 174" \
$CONVERT import $2/00178.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 175 175" \
$CONVERT import $2/00179.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 176 176" \
$CONVERT import $2/00180.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 177 177" \
$CONVERT import $2/00181.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 178 178" \
$CONVERT import $2/00182.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 179 179" \
$CONVERT import $2/00183.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 180 180" \
$CONVERT import $2/00184.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 181 181" \
$CONVERT import $2/00185.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 182 182" \
$CONVERT import $2/00186.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 183 183" \
$CONVERT import $2/00187.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 184 184" \
$CONVERT import $2/00188.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 185 185" \
$CONVERT import $2/00189.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 186 186" \
$CONVERT import $2/00190.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 187 187" \
$CONVERT import $2/00191.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 188 188" \
$CONVERT import $2/00192.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 189 189" \
$CONVERT import $2/00193.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 190 190" \
$CONVERT import $2/00194.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 191 191" \
$CONVERT import $2/00195.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 192 192" \
$CONVERT import $2/00196.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 193 193" \
$CONVERT import $2/00197.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 194 194" \
$CONVERT import $2/00198.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 195 195" \
$CONVERT import $2/00199.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 196 196" \
$CONVERT import $2/00200.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 197 197" \
$CONVERT import $2/00201.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 198 198" \
$CONVERT import $2/00202.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 199 199" \
$CONVERT import $2/00203.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 200 200" \
$CONVERT import $2/00204.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 201 201" \
$CONVERT import $2/00205.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 202 202" \
$CONVERT import $2/00206.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 203 203" \
$CONVERT import $2/00207.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 204 204" \
$CONVERT import $2/00208.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 205 205" \
$CONVERT import $2/00209.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 206 206" \
$CONVERT import $2/00210.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 207 207" \
$CONVERT import $2/00211.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 208 208" \
$CONVERT import $2/00212.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 209 209" \
$CONVERT import $2/00213.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 210 210" \
$CONVERT import $2/00214.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 211 211" \
$CONVERT import $2/00215.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 212 212" \
$CONVERT import $2/00216.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 213 213" \
$CONVERT import $2/00217.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 214 214" \
$CONVERT import $2/00218.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 215 215" \
$CONVERT import $2/00219.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 216 216" \
$CONVERT import $2/00220.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 217 217" \
$CONVERT import $2/00221.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 218 218" \
$CONVERT import $2/00222.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 219 219" \
$CONVERT import $2/00223.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 220 220" \
$CONVERT import $2/00224.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 221 221" \
$CONVERT import $2/00225.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 222 222" \
$CONVERT import $2/00226.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 223 223" \
$CONVERT import $2/00227.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 224 224" \
$CONVERT import $2/00228.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 225 225" \
$CONVERT import $2/00229.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 226 226" \
$CONVERT import $2/00230.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 227 227" \
$CONVERT import $2/00231.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 228 228" \
$CONVERT import $2/00232.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 229 229" \
$CONVERT import $2/00233.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 230 230" \
$CONVERT import $2/00234.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 231 231" \
$CONVERT import $2/00235.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 232 232" \
$CONVERT import $2/00236.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 233 233" \
$CONVERT import $2/00237.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 234 234" \
$CONVERT import $2/00238.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 235 235" \
$CONVERT import $2/00239.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 236 236" \
$CONVERT import $2/00240.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 237 237" \
$CONVERT import $2/00241.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 238 238" \
$CONVERT import $2/00242.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 239 239" \
$CONVERT import $2/00243.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 240 240" \
$CONVERT import $2/00244.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 241 241" \
$CONVERT import $2/00245.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 242 242" \
$CONVERT import $2/00246.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 243 243" \
$CONVERT import $2/00247.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 244 244" \
$CONVERT import $2/00248.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 245 245" \
$CONVERT import $2/00249.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 246 246" \
$CONVERT import $2/00250.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 247 247" \
$CONVERT import $2/00251.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 248 248" \
$CONVERT import $2/00252.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 249 249" \
$CONVERT import $2/00253.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 250 250" \
$CONVERT import $2/00254.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 251 251" \
$CONVERT import $2/00255.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 252 252" \
$CONVERT import $2/00256.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 253 253" \
$CONVERT import $2/00257.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 254 254" \
$CONVERT import $2/00258.jpeg export "$2/$3.idx" --field data --box "0 511 0 511 255 255" \