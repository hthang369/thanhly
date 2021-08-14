<?php $m= isset($_REQUEST["m"])?$_REQUEST["m"]:"";
	if(isset($m))
	{
		switch($m)
		{
			case "dsnsp":
				include "include/ds-nhomsp.php";
			break;
			case "dssphome";
				include "include/dssanphamhome.php";
			break;
			case "innsp";
				include "include/insert-nhomsp.php";
			break;
			case "insphome";
				include "include/insert_sphome.php";
			break;
			case "insp";
				include "include/insert.php";
			break;
			case "inlsp";
				include "include/insert-loaisp.php";
			break;
			case "inhsp";
				include "include/insert-hieusp.php";
			break;
			case "dssp";
				include "include/ds_sp.php";
			break;
			case "dpw";
				include "include/doi_pw.php";
			break;
			case "dshsp";
				include "include/ds_hieusp.php";
			break;
			case "tv";
				include "include/ds_tv.php";
			break;
			case "lienhe";
				include "include/ds_lh.php";
			break;
			case "upsp";
				include "include/update-sp.php";
			break;
			case "uptv":
				include "include/update_tv.php";
			break;
			case "upnsp":
				include "include/update_nsp.php";
			break;
			case "lsp":
				include "include/ds_lsp.php";
			break;
			case "dslnsp":
				include "include/ds_lnsp.php";
			break;
			case "upsphome":
				include "include/update_sphome.php";
			break;
			case "uplsp":
				include "include/update_lsp.php";
			break;
			case "uplh":
				include "include/update_lh.php";
			break;
			case "dslhsp":
				include "include/ds_hl.php";
			break;
			case "dskm":
				include "include/ds_km.php";
			break;
			case "inkm":
				include "include/insert_km.php";
			break;
			case "upkm":
				include "include/update_km.php";
			break;
			case "dsspl":
				include "include/ds_spl.php";
			break;
			case "dshd":
				include "include/donhang.php";
			break;
			case "cthd":
				include "include/chitiet_dh.php";
			break;
			case "dsgq":
				include "include/donhang_gq.php";
			break;
			case "ttcnad":
				include "include/ttcnad.php";
			break;
			case "dstintuc":
				include "include/ds_tintuc.php";
			break;
			case "up_tt":
				include "include/update_tt.php";
			break;
			case "intt":
				include "include/insert_tt.php";
			break;
				case "upndhome":
				include "include/upcontenthome.php";
			break;
		}
	}
 ?>