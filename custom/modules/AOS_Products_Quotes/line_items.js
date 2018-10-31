/**
 * Advanced OpenSales, Advanced, robust set of sales modules.
 * @package Advanced OpenSales for SugarCRM
 * @copyright SalesAgility Ltd http://www.salesagility.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SalesAgility <info@salesagility.com>
 */

$(document).ready(function(){
    $('#discount_amount_label').parent('tr').hide()
    
    var btnRefresh = $('.btn-refresh');
    
    $.each(btnRefresh, function(i, v) {
	$(v).trigger('click')
    });
});

Date.isLeapYear = function (year) {
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
};

Date.getDaysInMonth = function (year, month) {
    return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
};

Date.prototype.isLeapYear = function () {
    return Date.isLeapYear(this.getFullYear());
};

Date.prototype.getDaysInMonth = function () {
    return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
};

Date.prototype.addMonths = function (value) {
    var n = this.getDate();
    this.setDate(1);
    this.setMonth(this.getMonth() + value);
    this.setDate(Math.min(n, this.getDaysInMonth()));
    return this;
};
Date.prototype.subtractDays = function (value) {
    var n = this.getDate();
    this.setDate(n - value);
    return this;
}

var lineno;
var prodln = 0;
var servln = 0;
var groupn = 0;
var group_ids = {};

var currency_id_select = document.getElementById('currency_id_select');

currency_id_select.onchange = function() {
    CurrencyConvertAll(this.form);	
    calculateTotal();
    
    var listPriceFields = $('.global-list-price');
    
    $.each(listPriceFields, function(i, v) {
	var ln = $(v).data('id');
	var price = $(v).val();
	var fixPrice = get_value('product_hidden_fix_price' + ln);
	var origPrice = get_value('product_hidden_orig_price' + ln);
	
	var group_rate_id = currency_id_select.options[currency_id_select.selectedIndex].value;
	group_rate_id = group_rate_id ? group_rate_id : -99;

	var group_rate = get_rate(group_rate_id);
	group_rate = isNumeric(group_rate) ? group_rate : 0;

	var item_rate_id = document.getElementById('product_currency' + ln).value;
	item_rate_id = item_rate_id ? item_rate_id : -99;

	var item_rate = get_rate(item_rate_id);
	item_rate = isNumeric(item_rate) ? item_rate : 0;
	
	var fix_new_price = fixPrice * (item_rate / group_rate);
	var orig_new_price = origPrice * (item_rate / group_rate);
	
	document.getElementById('product_hidden_list_price' + ln).value = price;
	document.getElementById('product_hidden_unit_price' + ln).value = price;
	document.getElementById('product_hidden_fix_price' + ln).value = fix_new_price;
        document.getElementById('product_hidden_orig_price' + ln).value = orig_new_price;
        calculateLine(ln, "product_");
        var dis = document.getElementById('product_discount' + ln).value;
        if(dis == 'Amount') {
            var discount = get_value('product_product_discount' + ln);
            discount = discount * (item_rate / group_rate);
            document.getElementById('product_product_discount' + ln).value = format2Number(discount, 2);
            calculateLine(ln, "product_");
        }});
    
    //var curr = currency_id_select.options[currency_id_select.selectedIndex].value;
    //$('.product_global_currency').val(curr)
}

var cost_currency_list = SUGAR.language.languages.app_list_strings['cost_currency_list'];

/**
 * Get Cost Currency Symbol
 */
function get_cost_currency_name(val) {
    for (var k in cost_currency_list){
	if (cost_currency_list.hasOwnProperty(k)) {
	    if(k == val) {
		return cost_currency_list[k];
	    }
	}
    }

    return null;
}

/**
 * Get Cost Currency Symbol
 */
function get_cost_currency_symbol(val) {
    for (var k in cost_currency_list){
	if (cost_currency_list.hasOwnProperty(k)) {
	    if(cost_currency_list[k] == val) {
		return   k;
	    }
	}
    }

    return null;
}

/**
 * Get Cost Currency ID
 */
function get_cost_currency_id(symb) {
    for (var k in CurrencySymbols){
	if (CurrencySymbols.hasOwnProperty(k)) {
	    if(CurrencySymbols[k] == symb) {
		return k;
	    }
	}
    }

    return null;
}

/**
 * Show Popup
 */
var show_popup = function show_popup(row) {
    var w = 500;
    var h = 200;

    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;

    var prod_name = document.getElementById('product_name'+row).value;
    var prod_cost = document.getElementById('product_cost_2_c'+row).value;
    var prod_currency_cost = document.getElementById('product_cost_currency_c'+row).value;
    
    var win = window.open("", prod_name, "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width="+w+", height="+h+",top="+top+", left="+left);

    win.document.body.innerHTML =
	'<html><head><title>'+prod_name+'</title><style>' +
	'body {font-family: Arial; } ' +
	'table {font-size:12px !important; width:100%; } ' +
	'table tr td { border:1px solid #8c8c8c; padding:3px 5px;} ' +
	'table tr td.label { background:#3C8DBC; color:#fff; } ' +
	'</style></head><body>' +
	'<table><tbody>' +

    '<tr><td class="label">Product</td><td>' + (prod_name ? prod_name : '&lt;Not Set&gt;')+ '</td></tr>' +
	'<tr><td class="label">Cost</td><td>' + (prod_cost ? prod_cost : '&lt;Not Set&gt;')+ '</td></tr>' +
	'<tr><td class="label">Cost Currency</td><td>' + (prod_currency_cost ? prod_currency_cost : '&lt;Not Set&gt;') + '</td></tr>' +

    '</tbody></table>' +
	'</body></html>';
}


/**
 * Load Line Items
 */

function insertLineItems(product,group){

    var type = 'product_';
    var ln = 0;
    var current_group = 'lineItems';
    var gid = product.group_id;
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    var newrenewal = url.searchParams.get("renewed");
    
    if(typeof group_ids[gid] === 'undefined'){
	current_group = insertGroup();
	group_ids[gid] = current_group;
	for(var g in group){
	    if(document.getElementById('group'+current_group + g) !== null){
		document.getElementById('group'+current_group + g).value = group[g];
	    }
	}
    } else {
	current_group = group_ids[gid];
    }

    if(product.product_id != '0' && product.product_id !== ''){
	ln = insertProductLine('product_group'+current_group,current_group);
	type = 'product_';
    } else {
	ln = insertServiceLine('service_group'+current_group,current_group);
	type = 'service_';
    }

    for(var p in product){
	if(document.getElementById(type + p + ln) !== null){
	    if(p == 'product_list_price') {
		//	console.log(product[p]);
	    }
	    if(product[p] !== '' && isNumeric(product[p]) && p != 'vat'  && p != 'product_id' && p != 'name' && p != "part_number" && p != "cost_currency_c" && p != "cost_2_c" && p != "account_number_sales_c" && p != "account_number_purchase_c" && p!="job_number_text_c" && p!="tax_c" && p!='license_type_c' && p!='status_c' && p != 'is_ansys'){
		document.getElementById(type + p + ln).value = format2Number(product[p]);
	    } else if(p == "cost_2_c") {
		document.getElementById(type + p + ln).value = product['cost_c'];
		document.getElementById("product_cost_2_c_original" + ln).value = format_money(removeCurrency(product[p]));
	    } else if(p == "cost_discount_c") {
		document.getElementById("product_cost_discount_c" + ln).value = product[p] ? product[p] : '0.00';
	    } else {
		document.getElementById(type + p + ln).value = product[p];
	    }
	}

	if(p == "hidden_list_currency") {
	    document.getElementById(type + 'currency' + ln).value = product[p];
	}
    }

    /*var btnPopup = document.getElementById('product_show_popup'+ln);
      if(btnPopup != null) {
      btnPopup.onclick = function() { show_popup(ln, product); };
      }*/

    // ln, key, boolsaleprice = true, boollistprice = true, boolenddate = true, boolcost = true, boolquotedcost = true
    // Fix Quantity and item
    Itm_format2Number(ln);
    Quantity_format2Number(ln);
    if(newrenewal == 'true') {
	calculateLine(ln,type, true, true, true, true, true);
    } else {
	calculateLine(ln,type, false, false, true, false, false);
    }

}

/**
 * Check if numeric
 */
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * Remove Currency
 */
function removeCurrency(val) {
    val = val.toString();
    var newval = parseFloat(val.replace(/[^\d\.]/g,''));
    if(!isFloatCustom(newval)) { newval += '.00'; }

    return newval;
}

/**
 * Format Money
 */
function format_money(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/**
 * Check if Float
 */
function isFloatCustom(n){
    return Number(n) === n && n % 1 !== 0;
}

/**
 * Get Margin
 */
function getMargin(val) {

}

/**
 * Get Days
 */
function getDays(lineno) {
    var _startdate = $('#product_start_date_c'+lineno).val();
    var _enddate = $('#product_end_date_c'+lineno).val();

    if(_startdate && _enddate) {
	var startdate = parseDate(_startdate);
	var enddate = parseDate(_enddate);

	var days = Math.round((enddate-startdate)/(1000*60*60*24));
	return days + 1;
    }

    return -1;
}

/**
 * Date to YYYY/MM/DD
 */
function parseDate(str) {
    var dmy = str.split('/');
    return new Date(dmy[2], dmy[1]-1, dmy[0]);
}

/**
 * Date to DD/MM/YYYYY
 */
function formatDate(date) {
    if(date instanceof Date) {
	return ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();
    }

    return "";
}

/**
 * Event Trigger for License Type : Change
 */
function licenseTypeChange(lineno) {
    //console.log('lictypechange')
    var _lictype = $('#product_license_type_c'+lineno + ' option:selected').val();
    var lictypedate_hidden = $.parseJSON($('#lictypedatehidden').val().replace(/\'/g, '"'));
    var months = lictypedate_hidden[_lictype];

    //console.log('_lictype: ' + _lictype)

    //console.log('lictypechange1')
    var oprice = document.getElementById('product_hidden_orig_prod_price' + lineno).value
    document.getElementById('product_hidden_fix_price' + lineno).value = oprice;

    //console.log('lictypechange2')
    adjustStartEndDate(lineno, months);
    calculateLine(lineno,"product_", true, true, true, true, true);
    //console.log('lictypechange3')
    
    var price = document.getElementById('product_product_list_price' + lineno).value
    document.getElementById('product_hidden_list_price' + lineno).value = price;
}

function changeEndDate(ln, key){
    /*var origPrice = get_value(key + 'hidden_orig_prod_price' + ln);
      var origCostPrice = get_value(key + 'cost_2_c_original' + ln);
      var days = getDays(ln);

      // 365 = must be dynamic. include leap year - aevin
      // maintenance - aevin
      var newPrice = (days / 365) * origPrice;
      document.getElementById(key + 'hidden_list_price' + ln).value = newPrice;
      document.getElementById(key + 'product_list_price' + ln).value = newPrice;

      var newCostPrice = (days / 365) * origCostPrice;
      document.getElementById(key + 'cost_2_c' + ln).value = newCostPrice;
      document.getElementById(key + 'cost_2_c_hidden' + ln).value = newCostPrice;
      //document.getElementById(key + 'license_type_c' + ln).value = '';*/
    
    var msg = '';
    var start_date = $('#product_start_date_c' + ln).val();
    var end_date = $('#product_end_date_c' + ln).val();
    
    var moment_enddate_check = moment(end_date, "DD/MM/YYYY", true).isValid();
    
    if (!moment_enddate_check) {
	msg += "Invalid end date. Date format must be dd/mm/yyyy\n";
	alert(msg)
	$('#product_end_date_c' + ln).val('');
    }

    var groupid = 0;
    if(enable_groups){
        groupid = document.getElementById(key + 'group_number' + ln).value;
        groupid = 'group' + groupid + 'freezprice';

        var freezePrices = document.getElementById(groupid).checked;

        if (freezePrices)
            return;
    }
    
    calculateLine(ln, key, true, true, true, true, true)
}

function changeFixPrice(ln, key){
    var listPrice = get_value(key + 'product_list_price' + ln);
    document.getElementById(key + 'hidden_list_price' + ln).value = listPrice;
    document.getElementById(key + 'hidden_unit_price' + ln).value = listPrice;
    document.getElementById(key + 'hidden_fix_price' + ln).value = listPrice;

    var cost_price = document.getElementById(key + 'cost_2_c' + ln).value;

    if (confirm("Update Cost Price?")) {
        var new_cost = prompt("New Cost Price: ", cost_price);
        if (new_cost == null || new_cost == "" || isNaN(parseFloat(new_cost))) {
            alert("Error in value!");
        } else {
            cost_price = new_cost;
        }
        document.getElementById(key + 'cost_2_c' + ln).value = cost_price;
    }
    calculateLine(ln, key, true, false, true, false, true)
}

function changeDiscountType(ln, key) {
    var discount = get_value(key + 'product_discount' + ln);
    var dis = document.getElementById(key + 'discount' + ln).value;

    if(document.getElementById(key + 'product_list_price' + ln) !== null && document.getElementById(key + 'product_discount' + ln) !== null && document.getElementById(key + 'discount' + ln) !== null){
	var origPrice = get_value(key + 'product_list_price' + ln);
    }

    if(dis == 'Amount') {
        // Change Percentage to Amount
	var newDiscount = origPrice * discount / 100.0;
        document.getElementById(key + 'product_discount' + ln).value = format2Number(newDiscount);
    }
    else if(dis == 'Percentage') {
        // change Amount to Percentage
	var newDiscount = discount / origPrice*100.0;
        document.getElementById(key + 'product_discount' + ln).value = format2Number(newDiscount, 3);
    }
    calculateLine(ln, key, true,true,true,true,false);
}

function changeSalePrice(ln, key) {
    var unit_price = get_value(key + 'product_unit_price' + ln);
    var dis = document.getElementById(key + 'discount' + ln).value;

    if(document.getElementById(key + 'product_list_price' + ln) !== null && document.getElementById(key + 'product_discount' + ln) !== null && document.getElementById(key + 'discount' + ln) !== null){
	var origPrice = get_value(key + 'product_list_price' + ln);
    }

    var discount = 0.0;
    if(dis == 'Amount') {
	discount = origPrice - unit_price;
    }
    else if(dis == 'Percentage') {
	discount = (origPrice - unit_price)/origPrice*100.0;
    }

    document.getElementById(key + 'product_discount' + ln).value = format2Number(discount, 3);
    document.getElementById(key + 'product_unit_price' + ln).value = format2Number(unit_price);
    calculateLine(ln, key, false, true, true, true, true)
}

function adjustStartEndDate(lineno, months) {
    if(months > -1) {
	var _startDate = new Date();

	var _endDate = new Date(_startDate);
	_endDate = _endDate.addMonths(months);
	_endDate = _endDate.subtractDays(1);

	$('#product_start_date_c'+lineno).val(formatDate(_startDate));
	$('#product_end_date_c'+lineno).val(formatDate(_endDate));
    } else {
	$('#product_start_date_c'+lineno).val("");
	$('#product_end_date_c'+lineno).val("");
    }
}

/**
 * Compute Lease Line Items - ANSYS
 */
function computeLeaseAnsys(ln, annual_price, days) {
    //console.log('computeLeaseAnsys');
    annual_price = isNaN(annual_price) ? 0 : annual_price;

    var daysInYear = days_of_a_year(get_year());
    var selectedLicType = get_value('product_license_type_c' + ln);

    var new_price = 0;
    var daily_rate = annual_price / daysInYear;
    var pro_rated_lease_price = days * daily_rate;
    var multiplier = 0;
    var exceed_days = 0;
    var pro_rated_lease_price_exceed = 0;

    if(days <= 62) {
	multiplier = 2;
    } else if(days >= 63 && days <= 279) {
	multiplier = 1.35;
    } else if (days >= 280 && days <= 365) {
	multiplier = 1;
    } else if(days >= 366) {
	multiplier = -1;
    }

    if(selectedLicType == 12 || selectedLicType == 12 || selectedLicType == 112) {
	multiplier = 1;
    }

    if(multiplier > -1) {
	new_price = parseFloat(pro_rated_lease_price) * parseFloat(multiplier);
    } else {
	exceed_days = days - daysInYear;
	pro_rated_lease_price_exceed = exceed_days * daily_rate;

	new_price = parseFloat(annual_price) + parseFloat(pro_rated_lease_price_exceed);
    }

    /*console.log('============================ANSYS===================================');
      console.log('Price: ' + annual_price);
      console.log('Days: ' + days);
      console.log('Daily Rate: ' + daily_rate);
      console.log('Pro Rated Lease Price: ' + pro_rated_lease_price);
      console.log('Multiplier: ' + multiplier);
      console.log('Exceed Days: ' + exceed_days);
      console.log('Pro Rated Lease Price Exceeded: ' + pro_rated_lease_price_exceed);
      console.log('New Price: ' + new_price);
      console.log('=====================================================================');*/

    return new_price;
}

/**
 * Compute Lease Line Items - NOT ANSYS
 */
function computeLeaseNotAnsys(ln, annual_price, days) {
    console.log('computeLeaseNotAnsys');
    annual_price = isNaN(annual_price) ? 0 : annual_price;

    var daysInYear = days_of_a_year(get_year());
    var selectedLicType = get_value('product_license_type_c' + ln);

    var new_price = 0;
    var daily_rate = annual_price / daysInYear;
    var pro_rated_lease_price = days * daily_rate;
    var multiplier = 0;
    var exceed_days = 0;
    var pro_rated_lease_price_exceed = 0;

    if(days <= 62) {
	multiplier = 2;
    } else if(days >= 63 && days <= 279) {
	multiplier = 1.35;
    } else if (days >= 280 && days <= 365) {
	multiplier = 1;
    } else if(days >= 366) {
	multiplier = -1;
    }

    if(selectedLicType == 12 || selectedLicType == 12 || selectedLicType == 112) {
	multiplier = 1;
    }

    if(multiplier > -1) {
	new_price = parseFloat(pro_rated_lease_price) * parseFloat(multiplier);
    } else {
	exceed_days = days - daysInYear;
	pro_rated_lease_price_exceed = exceed_days * daily_rate;

	new_price = parseFloat(annual_price) + parseFloat(pro_rated_lease_price_exceed);
    }

    console.log('============================NOT ANSYS===================================');
    console.log('Price: ' + annual_price);
    console.log('Days: ' + days);
    console.log('Multiplier: ' + multiplier);
    console.log('New Price: ' + new_price);
    console.log('=====================================================================');

    return new_price;
}

/**
 * Compute Lease Line Items - PTC
 */
function computeLeasePTC(ln, annual_price, days) {
    //console.log('computeLeasePTC');
    annual_price = isNaN(annual_price) ? 0 : annual_price;

    var daysInYear = days_of_a_year(get_year());
    var new_price = 0;
    var daily_rate = annual_price / daysInYear;
    var pro_rated_lease_price = days * daily_rate;
    var multiplier = 0;
    var exceed_days = 0;
    var pro_rated_lease_price_exceed = 0;

    var selectedLicType = get_value('product_license_type_c' + ln);

    if(days <= 62) {
	multiplier = 2;
    } else if(days >= 63 && days <= 279) {
	multiplier = 1.35;
    } else if (days >= 280 && days <= 365) {
	multiplier = 1;
    } else if(days >= 366) {
	multiplier = -1;
    }

    if(selectedLicType == 12 || selectedLicType == 12 || selectedLicType == 112) {
	multiplier = 1;
    }

    if(multiplier > -1) {
	new_price = parseFloat(pro_rated_lease_price) * parseFloat(multiplier);
    } else {
	exceed_days = days - daysInYear;
	pro_rated_lease_price_exceed = exceed_days * daily_rate;

	new_price = parseFloat(annual_price) + parseFloat(pro_rated_lease_price_exceed);
    }

    return new_price;
}

/**
 * Compute Lease Line Items - NOT PTC
 */
function computeLeaseNotPTC(ln, annual_price, days) {
    //console.log('computeLeaseNotPTC');
    annual_price = isNaN(annual_price) ? 0 : annual_price;

    var new_price = 0;
    var multiplier = 0;
    var daysInYear = days_of_a_year(get_year());
    
    var selectedLicType = get_value('product_license_type_c' + ln);

    if(days <= 30) {
	multiplier = 0.175;
    } else if(days >= 31 && days <= 90) {
	multiplier = 0.35;
    } else if (days >= 91 && days <= 180) {
	multiplier = 0.7;
    } else if(days >= 181 && days <= daysInYear) {
	multiplier = 1;
    }
    
    if(selectedLicType == 12 || selectedLicType == 12 || selectedLicType == 112) {
	multiplier = 1;
    }

    new_price = parseFloat(annual_price) * parseFloat(multiplier);

    return new_price;
}

/**
 * Compute Maintenance
 */
function computeMaintenance(ln, price) {
    //console.log('computeMaintenance: ' + price);
    // change to pro-rata by day

    /*var origPrice = get_value(key + 'hidden_orig_prod_price' + ln);
      var origCostPrice = get_value(key + 'cost_2_c_original' + ln);*/
    var days = getDays(ln);
    var daysInYear = days_of_a_year(get_year());

    //console.log('days: ' + days)
    //console.log('daysInYear: ' + daysInYear)

    var newPrice = (days / daysInYear) * price;

    document.getElementById('product_hidden_list_price' + ln).value = newPrice;
    document.getElementById('product_product_list_price' + ln).value = newPrice;

    /*var newCostPrice = (days / daysInYear) * origCostPrice;
      document.getElementById(key + 'cost_2_c' + ln).value = newCostPrice;
      document.getElementById(key + 'cost_2_c_hidden' + ln).value = newCostPrice;
      //document.getElementById(key + 'license_type_c' + ln).value = '';

      calculateLine(ln, key, true, false, true, false)

      // ===============
      var _startdate = $('#product_start_date_c'+lineno).val();
      var _enddate = $('#product_end_date_c'+lineno).val();

      if(_startdate && _enddate) {
      var startdate = parseDate(_startdate);
      var enddate = parseDate(_enddate);

      var start_date_month = startdate.getMonth() + 1;
      var start_date_year = startdate.getFullYear();

      var end_date_month = enddate.getMonth() + 1;
      var end_date_year = enddate.getFullYear();

      year_sub = end_date_year - start_date_year;
      month_sub = end_date_month - start_date_month;

      number_of_months = (year_sub * 12) + month_sub;

      var new_price = (number_of_months / 12) * parseFloat(annual_price);

      return new_price;

      }*/

    return newPrice;
}

function get_year() {
    var year = new Date().getFullYear();
    //console.log("Current Year: " + year);
    return year;
}

function days_of_a_year(year) {
    var is_leap_year = isLeapYear(year) ? 366 : 365;
    //console.log("Is Leap Year: " + is_leap_year);

    return is_leap_year;
}

function isLeapYear(year) {
    return year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0);
}

/**
 * Insert product line
 */

function insertProductLine(tableid, groupid) {

    if(!enable_groups){
	tableid = "product_group0";
    }

    if (document.getElementById(tableid + '_head') !== null) {
	document.getElementById(tableid + '_head').style.display = "";
    }

    var module = document.getElementById('_module').value;
    var vat_hidden = document.getElementById("vathidden").value;
    var lictype_hidden = document.getElementById("lictypehidden").value;
    var status_hidden = document.getElementById("statushidden").value;
    var discount_hidden = document.getElementById("discounthidden").value;
    var tax_hidden = document.getElementById("taxhidden").value;

    /*sqs_objects["product_name[" + prodln + "]"] = {
      "form": "EditView",
      "method": "query",
      "modules": ["AOS_Products"],
      "group": "or",
      "field_list": ["name", "id","part_number", "cost", "price","description","currency_id"],
      "populate_list": ["product_name[" + prodln + "]", "product_product_id[" + prodln + "]", "product_part_number[" + prodln + "]", "product_product_cost_price[" + prodln + "]", "product_product_list_price[" + prodln + "]", "product_item_description[" + prodln + "]", "product_currency[" + prodln + "]"],
      "required_list": ["product_id[" + prodln + "]"],
      "conditions": [{
      "name": "name",
      "op": "like_custom",
      "end": "%",
      "value": ""
      }],
      "order": "name",
      "limit": "30",
      "post_onblur_function": "formatListPrice(" + prodln + ");",
      "no_match_text": "No Match"
      };*/
    sqs_objects["product_part_number[" + prodln + "]"] = {
	"form": "EditView",
	"method": "query",
	"modules": ["AOS_Products"],
	"group": "or",
	"field_list": ["part_number", "name", "id","cost", "price","description","currency_id"],
	"populate_list": ["product_part_number[" + prodln + "]", "product_name[" + prodln + "]", "product_product_id[" + prodln + "]",  "product_product_cost_price[" + prodln + "]", "product_product_list_price[" + prodln + "]", "product_item_description[" + prodln + "]", "product_currency[" + prodln + "]"],
	"required_list": ["product_id[" + prodln + "]"],
	"conditions": [{
	    "name": "part_number",
	    "op": "like_custom",
	    "end": "%",
	    "value": ""
	}],
	"order": "name",
	"limit": "30",
	"post_onblur_function": "formatListPrice(" + prodln + ");",
	"no_match_text": "No Match"
    };

    tablebody = document.createElement("tbody");
    tablebody.id = "product_body" + prodln;
    document.getElementById(tableid).appendChild(tablebody);


    var cellno_row1 = 0;

    var x = tablebody.insertRow(-1);
    x.id = 'product_line' + prodln;

    var sr_cel = x.insertCell(cellno_row1);
    sr_cel.innerHTML = "<input type='text' name='product_number[" + prodln + "]' id='product_number" + prodln + "' size='5' value='' title='' tabindex='116' onblur='Itm_format2Number(" + prodln + ")'>";
    document.getElementById('product_number' + prodln).value = (parseInt(prodln) + 1).toString();
    cellno_row1++;

     var a = x.insertCell(cellno_row1);
    a.innerHTML = "<input type='text' name='product_product_qty[" + prodln + "]' id='product_product_qty" + prodln + "' size='5' value='' title='' tabindex='116' onblur='Quantity_format2Number(" + prodln + ");calculateLine(" + prodln + ",\"product_\", true, true, true, true, true);'>" +
	"<input type='hidden' name='product_is_ansys[" + prodln + "]' id='product_is_ansys" + prodln + "' value='' />";
    cellno_row1++;

    var b = x.insertCell(cellno_row1);
    b.innerHTML = "<input class='sqsEnabled product_name yui-ac-input' autocomplete='off' type='text' name='product_name[" + prodln + "]' id='product_name" + prodln + "' maxlength='50' value='' title='' tabindex='116' value='' readonly='readonly'><input type='hidden' name='product_product_id[" + prodln + "]' id='product_product_id" + prodln + "' size='20' maxlength='50' value=''>";
    cellno_row1++;

    var b1 = x.insertCell(cellno_row1);
    b1.innerHTML = "<input class='sqsEnabled product_part_number yui-ac-input' autocomplete='off' type='text' name='product_part_number[" + prodln + "]' id='product_part_number" + prodln + "' maxlength='50' value='' title='' tabindex='116' value='' readonly='readonly'>";
    cellno_row1++;

    var b2 = x.insertCell(cellno_row1);
    b2.innerHTML = "<button title='" + SUGAR.language.get('app_strings', 'LBL_SELECT_BUTTON_TITLE') + "' accessKey='" + SUGAR.language.get('app_strings', 'LBL_SELECT_BUTTON_KEY') + "' type='button' tabindex='116' class='button' value='" + SUGAR.language.get('app_strings', 'LBL_SELECT_BUTTON_LABEL') + "' name='btn1' onclick='openProductPopup(" + prodln + ");'><img src='themes/default/images/id-ff-select.png' alt='" + SUGAR.language.get('app_strings', 'LBL_SELECT_BUTTON_LABEL') + "'></button>";
    // "<button title='Show Popup' type='button' tabindex='116' class='button' value='' name='btn1' id='product_show_popup" + prodln + "' onclick='show_popup("+prodln+")'><img src='themes/default/images/currencies.gif' alt='Show Popup'></button>";
    cellno_row1++;

    if(module == 'AOS_Invoices') {
	var b3_1 = x.insertCell(cellno_row1);
	b3_1.innerHTML += "<select style='width:80px' name='product_status_c[" + prodln + "]' id='product_status_c" + prodln + "'>" + status_hidden + "</select>";
	cellno_row1++;
    }

    var b3 = x.insertCell(cellno_row1);
    b3.innerHTML += "<select style='width:100px;margin-left: 5px;margin-right: 5px;' name='product_license_type_c[" + prodln + "]' id='product_license_type_c" + prodln + "'>" + lictype_hidden + "</select>";
    cellno_row1++;

    var b4 = x.insertCell(cellno_row1);
    b4.innerHTML = "<span class='dateTime'><input class='date_input' autocomplete='off' type='text' name='product_start_date_c[" + prodln + "]' id='product_start_date_c" + prodln + "' maxlength='50' value='' title='' value='' readonly='readonly'>" +
	"<img src='themes/SuiteR/images/jscalendar.gif?v=D98fIvFyFVIrUmxUxLoQSg' alt='Enter Date' style='position:relative; top:6px; display:none;' border='0' id='product_start_date_c" + prodln + "_trigger'></span>";
    cellno_row1++;

    var b5 = x.insertCell(cellno_row1);
    b5.innerHTML = "<span class='dateTime'><input class='date_input' autocomplete='off' type='text' name='product_end_date_c[" + prodln + "]' id='product_end_date_c" + prodln + "' maxlength='50' value='' title='' value='' onchange='changeEndDate(" + prodln + ",\"product_\");' >" +
	"<img src='themes/SuiteR/images/jscalendar.gif?v=D98fIvFyFVIrUmxUxLoQSg' alt='Enter Date' style='position:relative; top:6px; display:none;' border='0' id='product_end_date_c" + prodln + "_trigger'></span>";
    cellno_row1++;

    var c = x.insertCell(cellno_row1);
    c.innerHTML = "<input style='text-align: right;' type='text' class='global-list-price' name='product_product_list_price[" + prodln + "]' class='product_global_list_price' data-id='" + prodln + "' id='product_product_list_price" + prodln + "' size='11' maxlength='50' value='' title='' tabindex='116' onchange='changeFixPrice(" + prodln + ",\"product_\");'>" +
	"<input type='hidden' name='product_current_active_lineitem_c[" + prodln + "]' id='product_current_active_lineitem_c" + prodln + "' value=''  />" +
	"<input type='hidden' name='product_hidden_orig_prod_price[" + prodln + "]' id='product_hidden_orig_prod_price" + prodln + "' value=''  />" +
	"<input type='hidden' name='product_hidden_orig_price[" + prodln + "]' id='product_hidden_orig_price" + prodln + "' value=''  />" +
	"<input type='hidden' name='product_hidden_fix_price[" + prodln + "]' id='product_hidden_fix_price" + prodln + "' value=''  />" +
	"<input type='hidden' name='product_hidden_list_price[" + prodln + "]' id='product_hidden_list_price" + prodln + "' value=''  />" +
	"<input type='hidden' name='product_product_cost_price[" + prodln + "]' id='product_product_cost_price" + prodln + "' value=''  />";
    cellno_row1++;

    if (typeof currencyFields !== 'undefined'){

	currencyFields.push("product_product_list_price" + prodln);
	currencyFields.push("product_product_cost_price" + prodln);

    }

    var d = x.insertCell(cellno_row1);
    d.innerHTML = "<input type='text' style='text-align: right; width:45%;' name='product_product_discount[" + prodln + "]' id='product_product_discount" + prodln + "' size='12' maxlength='50' value='' title='' tabindex='116' onchange='calculateLine(" + prodln + ",\"product_\", true, true, true, true, false);' onchange='calculateLine(" + prodln + ",\"product_\", true, true, true, true, false);'><input type='hidden' name='product_product_discount_amount[" + prodln + "]' id='product_product_discount_amount" + prodln + "' value=''  />";
    d.innerHTML += "<select tabindex='116' style='width:45%;margin-left: 5px;'  name='product_discount[" + prodln + "]' id='product_discount" + prodln + "' onchange='changeDiscountType(" + prodln + ",\"product_\")'>" + discount_hidden + "</select>";
    cellno_row1++;

    var e = x.insertCell(cellno_row1);
    e.innerHTML = "<input type='text' style='text-align: right;' onchange='changeSalePrice(" + prodln + ",\"product_\")' name='product_product_unit_price[" + prodln + "]' id='product_product_unit_price" + prodln + "' size='11' maxlength='50' value='' title='' tabindex='116'>" +
	"<input type='hidden' name='product_hidden_unit_price[" + prodln + "]' id='product_hidden_unit_price" + prodln + "' value=''  />";
    cellno_row1++;

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("product_product_unit_price" + prodln);
    }

    var f = x.insertCell(cellno_row1);
    f.innerHTML = "<input type='text' style='text-align: right; width:45%;' name='product_vat_amt[" + prodln + "]' id='product_vat_amt" + prodln + "' size='11' maxlength='250' value='' title='' tabindex='116' readonly='readonly'>";
    f.innerHTML += "<select tabindex='116' style='width:50%; margin-left: 5px;' name='product_vat[" + prodln + "]' id='product_vat" + prodln + "' onchange='calculateLine(" + prodln + ",\"product_\", true, true,true,true,false);'>" + vat_hidden + "</select>";
    cellno_row1++;

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("product_vat_amt" + prodln);
    }
    var g = x.insertCell(cellno_row1);
    g.innerHTML = "<input type='text' style='text-align: right;' name='product_product_total_price[" + prodln + "]' id='product_product_total_price" + prodln + "' size='11' maxlength='50' value='' title='' tabindex='116' readonly='readonly'><input type='hidden' name='product_group_number[" + prodln + "]' id='product_group_number" + prodln + "' value='"+groupid+"'>";
    cellno_row1++;

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("product_product_total_price" + prodln);
    }
    var h = x.insertCell(cellno_row1);
    h.innerHTML = "<input type='hidden' class='product_global_currency' name='product_currency[" + prodln + "]' id='product_currency" + prodln + "' value=''><input type='hidden' name='product_deleted[" + prodln + "]' id='product_deleted" + prodln + "' value='0'><input type='hidden' name='product_id[" + prodln + "]' id='product_id" + prodln + "' value=''>" +
	"<button type='button' id='product_delete_line" + prodln + "' class='button' value='" + SUGAR.language.get(module_sugar_grp1, 'LBL_REMOVE_PRODUCT_LINE') + "' tabindex='116' onclick='markLineDeleted(" + prodln + ",\"product_\")'><img src='themes/default/images/id-ff-clear.png' alt='" + SUGAR.language.get(module_sugar_grp1, 'LBL_REMOVE_PRODUCT_LINE') + "'></button><br>";
    cellno_row1++;

    enableQS(true);
    //QSFieldsArray["EditView_product_name"+prodln].forceSelection = true;

    var cellno_row1 = 0;

    var y = tablebody.insertRow(-1);
    y.id = 'product_note_line' + prodln;

    var h1 = y.insertCell(cellno_row1);
    h1.colSpan = "3";
    //h1.style.color = "rgb(68,68,68)";
    h1.innerHTML = "<span class='product_description_label' style='vertical-align: top;'>" + SUGAR.language.get(module_sugar_grp1, 'LBL_PRODUCT_DESCRIPTION') + " :&nbsp;&nbsp;</span>";
    h1.innerHTML += "<textarea class='product_description' tabindex='116' name='product_item_description[" + prodln + "]' id='product_item_description" + prodln + "' rows='2' cols='23'></textarea>&nbsp;&nbsp;";
    cellno_row1++;

    var i = y.insertCell(cellno_row1);
    i.colSpan = "3";
    //i.style.color = "rgb(68,68,68)";
    i.innerHTML = "<span class='product_description_label' style='vertical-align: top;'>"  + SUGAR.language.get(module_sugar_grp1, 'LBL_PRODUCT_NOTE') + " :&nbsp;</span>";
    i.innerHTML += "<textarea class='product_description' tabindex='116' name='product_description[" + prodln + "]' id='product_description" + prodln + "' rows='2' cols='35'></textarea>&nbsp;&nbsp;";
    cellno_row1++;

    var j = y.insertCell(cellno_row1);
    j.colSpan = "1";
    //j.style.color = "rgb(68,68,68)";
    j.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Cost</span><br/>";
    j.innerHTML += "<input type='text' name='product_cost_2_c[" + prodln + "]' id='product_cost_2_c" + prodln + "' readonly='readonly' style='text-align: right;'></input>";
    j.innerHTML += "<input type='hidden' name='product_cost_2_c_original[" + prodln + "]' id='product_cost_2_c_original" + prodln + "' readonly='readonly'></input>";
    j.innerHTML += "<input type='hidden' name='product_cost_2_c_hidden[" + prodln + "]' id='product_cost_2_c_hidden" + prodln + "' readonly='readonly'></input>";
    cellno_row1++;

    var k = y.insertCell(cellno_row1);
    k.colSpan = "1";
    //k.style.color = "rgb(68,68,68)";
    k.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Cost Currency</span><br/>";
    k.innerHTML += "<input type='text' name='product_cost_currency_c[" + prodln + "]' id='product_cost_currency_c" + prodln + "' readonly='readonly'></input>";
    cellno_row1++;

    var k = y.insertCell(cellno_row1);
    k.colSpan = "1";
    //k.style.color = "rgb(68,68,68)";
    k.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Supplier Margin</span><br/>";
    k.innerHTML += "<input type='text' name='product_supplier_margin_c[" + prodln + "]' id='product_supplier_margin_c" + prodln + "' onchange='calculateLine(" + prodln + ",\"product_\",false,false,false,false,true);'></input>";
    cellno_row1++;

    var k = y.insertCell(cellno_row1);
    k.colSpan = "1";
    //k.style.color = "rgb(68,68,68)";
    k.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Cost Discount (%)</span><br/>";
    k.innerHTML += "<input type='text' name='product_cost_discount_c[" + prodln + "]' id='product_cost_discount_c" + prodln + "' onchange='calculateLine(" + prodln + ",\"product_\",false,false,false,false,true);' style='text-align:right;'></input>";
    cellno_row1++;

    var k = y.insertCell(cellno_row1);
    k.colSpan = "1";
    //k.style.color = "rgb(68,68,68)";
    k.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Quoted Cost</span><br/>";
    k.innerHTML += "<input style='text-align: right;' type='text' name='product_supplier_amount_c[" + prodln + "]' id='product_supplier_amount_c" + prodln + "' onchange='calculateLine(" + prodln + ",\"product_\", false, false, false, false, false);'>" +
	"</input>";
    cellno_row1++;

    if(module == 'AOS_Quotes') {
	var k = y.insertCell(cellno_row1);
	k.colSpan = "1";
	//k.style.color = "rgb(68,68,68)";
	k.innerHTML = "<span style='vertical-align: top;font-size: 11px;'>Margin</span><br/>";
	k.innerHTML += "<input type='text' name='product_margin[" + prodln + "]' id='product_margin" + prodln + "' value='0%' readonly='readonly' style='text-align: right; width:115px;'></input>";
	cellno_row1++;
    }

    if(module == 'AOS_Invoices') {
	var k = y.insertCell(cellno_row1);
	k.colSpan = "1";
	//k.style.color = "rgb(68,68,68)";
	k.innerHTML = "<span style='vertical-align: top;'>Account Number :&nbsp;</span><br/>";
	k.innerHTML += "<input type='text' readonly='readonly' style='width:100%' name='product_account_number_sales_c[" + prodln + "]' id='product_account_number_sales_c" + prodln + "' />";
	k.innerHTML += "<input type='hidden' name='product_account_number_purchase_c[" + prodln + "]' id='product_account_number_purchase_c" + prodln + "' />";
	cellno_row1++;

	var k = y.insertCell(cellno_row1);
	k.colSpan = "1";
	//k.style.color = "rgb(68,68,68)";
	k.innerHTML = "<span style='vertical-align: top;'>Job Number :&nbsp;</span><br/>";
	k.innerHTML += "<input type='text' readonly='readonly' style='width:100%' name='product_job_number_text_c[" + prodln + "]' id='product_job_number_text_c" + prodln + "' />";
	cellno_row1++;
    }

    var z = tablebody.insertRow(-1);
    z.id = 'line_item_separator'+lineno;

    var z1 = z.insertCell(0);

    var lineno = prodln;

    $('#product_license_type_c' + lineno).on('change', function(){
	licenseTypeChange(lineno);
    });

    $('#product_end_date_c' + lineno).datepicker({
	dateFormat: 'dd/mm/yy',
	onSelect: function(){
	    //getDays(lineno);
	    //calculateLine(lineno,"product_");
	    changeEndDate(lineno,"product_");
	}
    });

    $('#product_start_date_c' + lineno).datepicker({
	dateFormat: 'dd/mm/yy',
	onSelect: function(date){
	    //getDays(lineno);
	    var minDate = $(this).datepicker('getDate');
	    $('#product_end_date_c' + lineno).datepicker('option', 'minDate', minDate);
	    //$('#product_end_date_c' + lineno).datepicker('setDate', minDate);
            var groupid = 0;
            if(enable_groups){
                groupid = document.getElementById('product_' + 'group_number' + lineno).value;
                groupid = 'group' + groupid + 'freezprice';
                var freezePrices = document.getElementById(groupid).checked;
                if (!freezePrices){
                    calculateLine(lineno,"product_",true,true,true,true,true);}}}});

    addToValidate('EditView','product_product_id'+prodln,'id',true,"Please choose a product");
    prodln++;

    return prodln - 1;
}


/**
 * Open product popup
 */
function openProductPopup(ln){

    lineno=ln;
    var popupRequestData = {
	"call_back_function" : "setProductReturn",
	"form_name" : "EditView",
	"field_to_name_array" : {
	    "id" : "product_product_id" + ln,
	    "name" : "product_name" + ln,
	    "description" : "product_item_description" + ln,
	    "part_number" : "product_part_number" + ln,
	    "cost" : "product_product_cost_price" + ln,
	    "price" : "product_product_list_price" + ln,
	    "currency_id" : "product_currency" + ln,
	    "cost_2_c" : "product_cost_2_c" + ln,
	    "cost_currency_c" : "product_cost_currency_c" + ln,
	    "supplier_amount_c" : "product_supplier_amount_c" + ln,
	    "supplier_margin_c" : "product_supplier_margin_c" + ln,
	    "cost_discount_c" : "product_cost_discount_c" + ln,
	    "is_ansys" : "product_is_ansys" + ln,
	    "myob_accnum_sales_c" : "product_account_number_sales_c" + ln,
	    "myob_accnum_purchase_c" : "product_account_number_purchase_c" + ln,
	    "myob_job_groupid_c" : "product_job_number_text_c" + ln,
	},

    };

    var filter = '&obsolete_c_advanced=0';
    open_popup('AOS_Products', 800, 850, filter, true, true, popupRequestData);

}

function setProductReturn(popupReplyData){

    var _invoice = $('#_invoice').val();
    var _product_name = popupReplyData.name_to_value_array["product_name" + lineno];
    var _product_id = popupReplyData.name_to_value_array["product_product_id" + lineno];
    var _license_type = _product_name.split(" - ").pop()

    var _purchase_acc_num = popupReplyData.name_to_value_array["product_account_number_purchase_c" + lineno];
    var _job_num = popupReplyData.name_to_value_array["product_job_number_text_c" + lineno];
    
    var _group = 0;
    var _name = $('#product_name' + lineno);
    var _parent = _name.closest('table');
    
    if(_parent) {
	var _parentgroup = _parent.attr('id').replace("product_group", "");
	
	if(_parentgroup) {
	    _group = _parentgroup;
	}
    }
    
    console.log(_group);

    if(_license_type == 'Paid Up') {
	_product_name = _product_name.replace("+", "%2B");

	$.ajax({
	    type: 'get',
	    async: false,
	    url: 'index.php?module=AOS_Products_Quotes&action=get_maintenance&id=' + _product_id + '&name=' + _product_name,
	    error: function(req, status) {
		return false;
	    },
	    success: function(ret) {
		var json = $.parseJSON(ret);
		var newlineno = insertProductLine("product_group" + _group, _group);
		var _new_job_num = json.myob_job_groupid_c;

		var _startDate = new Date();

		var _endDate = new Date(_startDate);
		_endDate = _endDate.addMonths(12);
		_endDate = _endDate.subtractDays(1);

		var tmpReplyData = {};
		tmpReplyData["product_product_id" + newlineno] = json.id;
		tmpReplyData["product_name" + newlineno] = json.name;
		tmpReplyData["product_item_description" + newlineno] = json.description;
		tmpReplyData["product_part_number" + newlineno] = json.part_number;
		tmpReplyData["product_product_cost_price" + newlineno] = json.cost_2_c;
		tmpReplyData["product_product_list_price" + newlineno] = json.price;
		tmpReplyData["product_hidden_list_price" + newlineno] = json.price;
		tmpReplyData["product_hidden_orig_prod_price" + newlineno] = json.price;
		tmpReplyData["product_hidden_orig_price" + newlineno] = json.price;
		tmpReplyData["product_hidden_fix_price" + newlineno] = json.price;
		tmpReplyData["product_hidden_unit_price" + newlineno] = json.price;
		tmpReplyData["product_currency" + newlineno] = json.currency_id;
		tmpReplyData["product_cost_2_c" + newlineno] = json.cost_2_c;
		tmpReplyData["product_cost_2_c_original" + newlineno] = json.cost_2_c;
		tmpReplyData["product_cost_currency_c" + newlineno] = get_cost_currency_name(json.cost_currency_c);
		tmpReplyData["product_supplier_amount_c" + newlineno] = ""
		tmpReplyData["product_supplier_margin_c" + newlineno] = json.supplier_margin_c;
		tmpReplyData["product_cost_discount_c" + newlineno] = "0";
		tmpReplyData["product_is_ansys" + newlineno] = "0";
		tmpReplyData["product_account_number_sales_c" + newlineno] = json.myob_accnum_sales_c;
		tmpReplyData["product_account_number_purchase_c" + newlineno] = json.myob_accnum_purchase_c;
		tmpReplyData["product_start_date_c" + newlineno] = formatDate(_startDate);
		tmpReplyData["product_end_date_c" + newlineno] = formatDate(_endDate);

		var newPopupReplyData = {
		    form_name: "EditView",
		    name_to_value_array: tmpReplyData,
		    passthru_data: {},
		    popupConfirm: 0
		};

		set_return(newPopupReplyData);

		// GET JOB NUMBER AND STATE
		$.ajax({
		    type: 'get',
		    async: false,
		    url: 'index.php?module=AOS_Products_Quotes&action=getjobnum&id=' + _invoice,
		    error: function(req, status) {
			return false;
		    },
		    success: function(ret) {
			var job_state = ret;
			$('#product_job_number_text_c' + newlineno).val(job_state + _new_job_num);
		    }

		})
		
		$('#product_license_type_c'+newlineno).val(13);
		$('#product_license_type_c'+newlineno).trigger('change');

		formatListPrice(newlineno);
	    }

	})
    }

    set_return(popupReplyData);

    // SET HIDDEN LIST PRICE and COST PRICE
    var list_price = $("#product_product_list_price" + lineno).val();
    var cost_price = $("#product_cost_2_c" + lineno).val();
    var unit_price = $("#product_product_unit_price" + lineno).val();
    $("#product_hidden_list_price" + lineno).val(list_price);
    $("#product_hidden_fix_price" + lineno).val(list_price);
    $("#product_hidden_orig_price" + lineno).val(list_price);
    $("#product_hidden_orig_prod_price" + lineno).val(list_price);
    $("#product_hidden_unit_price" + lineno).val(list_price);
    
    $("#product_cost_2_c_original" + lineno).val(cost_price);

    var cost_discount = $("#product_cost_discount_c" + lineno).val();
    cost_discount = isNumeric(cost_discount) ? cost_discount : 0 ;
    $("#product_cost_discount_c" + lineno).val(cost_discount);

    // SET PURCHASE ACCOUNT NUM
    $('#product_account_number_purchase_c'+lineno).val(_purchase_acc_num);

    // SET SUPPLIER AMOUNT - FOR UNDEFINED
    $('#product_supplier_amount_c'+lineno).val("");

    // CHECK LICENSE TYPE
    if(_license_type == 'Paid Up') {
	var _startDate = new Date();
	$('#product_start_date_c'+lineno).val(formatDate(_startDate));
    }

    if(_license_type == 'Maintenance') {
	$('#product_license_type_c'+lineno).val(13);
	$('#product_license_type_c'+lineno).trigger('change');
    }

    if(_license_type == 'Lease' || _license_type == 'Subscription') {
	$('#product_license_type_c'+lineno).val(12);
	$('#product_license_type_c'+lineno).trigger('change');
	
	$.ajax({
	    type: 'get',
	    async: false,
	    url: 'index.php?module=AOS_Products_Quotes&action=checkisansys&id=' + _product_id,
	    error: function(req, status) {
		return false;
	    },
	    success: function(ret) {
		var is_ansys = ret;
		$('#product_is_ansys' + lineno).val(is_ansys);
	    }

	})
    }

    // GET JOB NUMBER AND STATE
    $.ajax({
	type: 'get',
	async: false,
	url: 'index.php?module=AOS_Products_Quotes&action=getjobnum&id=' + _invoice,
	error: function(req, status) {
	    return false;
	},
	success: function(ret) {
	    var job_state = ret;
	    $('#product_job_number_text_c' + lineno).val(job_state + _job_num);
	}

    })

    calculateLine(lineno, "product_")
    formatListPrice(lineno);
}

function formatListPrice(ln){
    //console.log('fn:formatListPrice')
    if (typeof currencyFields !== 'undefined'){
	var product_currency_id = document.getElementById('product_currency' + ln).value;
	product_currency_id = product_currency_id ? product_currency_id : -99;//Assume base currency if no id
	var product_currency_rate = get_rate(product_currency_id);
	var dollar_product_price = ConvertToDollar(document.getElementById('product_product_list_price' + ln).value, product_currency_rate);
	document.getElementById('product_product_list_price' + ln).value = format2Number(ConvertFromDollar(dollar_product_price, lastRate));
	var dollar_product_cost = ConvertToDollar(document.getElementById('product_product_cost_price' + ln).value, product_currency_rate);
	document.getElementById('product_product_cost_price' + ln).value = format2Number(ConvertFromDollar(dollar_product_cost, lastRate));
    }
    else
    {
	//console.log('fn:formatListPrice = ' + document.getElementById('product_product_list_price' + ln).value)
	document.getElementById('product_product_list_price' + ln).value = format2Number(document.getElementById('product_product_list_price' + ln).value);
	document.getElementById('product_product_cost_price' + ln).value = format2Number(document.getElementById('product_product_cost_price' + ln).value);
    }

    calculateLine(ln,"product_", false, false,true,true,true);
    //Commented this to not recalculate each line
    //currency_id_select.onchange();
}


/**
 * Insert Service Line
 */

function insertServiceLine(tableid, groupid) {

    if(!enable_groups){
	tableid = "service_group0";
    }
    if (document.getElementById(tableid + '_head') !== null) {
	document.getElementById(tableid + '_head').style.display = "";
    }

    var vat_hidden = document.getElementById("vathidden").value;
    var discount_hidden = document.getElementById("discounthidden").value;

    tablebody = document.createElement("tbody");
    tablebody.id = "service_body" + servln;
    document.getElementById(tableid).appendChild(tablebody);

    var x = tablebody.insertRow(-1);
    x.id = 'service_line' + servln;

    var a = x.insertCell(0);
    a.colSpan = "4";
    a.innerHTML = "<textarea name='service_name[" + servln + "]' id='service_name" + servln + "' size='16' cols='64' title='' tabindex='116'></textarea><input type='hidden' name='service_product_id[" + servln + "]' id='service_product_id" + servln + "' size='20' maxlength='50' value='0'>";

    var a1 = x.insertCell(1);
    a1.innerHTML = "<input type='text' style='text-align: right; width:115px;' name='service_product_list_price[" + servln + "]' id='service_product_list_price" + servln + "' size='11' maxlength='50' value='' title='' tabindex='116'   onblur='calculateLine(" + servln + ",\"service_\");'>";

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("service_product_list_price" + servln);
    }

    var a2 = x.insertCell(2);
    a2.innerHTML = "<input type='text' style='text-align: right; width:90px;' name='service_product_discount[" + servln + "]' id='service_product_discount" + servln + "' size='12' maxlength='50' value='' title='' tabindex='116' onblur='calculateLine(" + servln + ",\"service_\");' onblur='calculateLine(" + servln + ",\"service_\");'><input type='hidden' name='service_product_discount_amount[" + servln + "]' id='service_product_discount_amount" + servln + "' value=''  />";
    a2.innerHTML += "<select tabindex='116' name='service_discount[" + servln + "]' id='service_discount" + servln + "' onchange='calculateLine(" + servln + ",\"service_\");'>" + discount_hidden + "</select>";

    var b = x.insertCell(3);
    b.innerHTML = "<input type='text' style='text-align: right; width:115px;' name='service_product_unit_price[" + servln + "]' id='service_product_unit_price" + servln + "' size='11' maxlength='50' value='' title='' tabindex='116'   onblur='calculateLine(" + servln + ",\"service_\");'>";

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("service_product_unit_price" + servln);
    }
    var c = x.insertCell(4);
    c.innerHTML = "<input type='text' style='text-align: right; width:90px;' name='service_vat_amt[" + servln + "]' id='service_vat_amt" + servln + "' size='11' maxlength='250' value='' title='' tabindex='116' readonly='readonly'>";
    c.innerHTML += "<select tabindex='116' name='service_vat[" + servln + "]' id='service_vat" + servln + "' onchange='calculateLine(" + servln + ",\"service_\");'>" + vat_hidden + "</select>";
    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("service_vat_amt" + servln);
    }

    var e = x.insertCell(5);
    e.innerHTML = "<input type='text' style='text-align: right; width:115px;' name='service_product_total_price[" + servln + "]' id='service_product_total_price" + servln + "' size='11' maxlength='50' value='' title='' tabindex='116' readonly='readonly'><input type='hidden' name='service_group_number[" + servln + "]' id='service_group_number" + servln + "' value='"+ groupid +"'>";

    if (typeof currencyFields !== 'undefined'){
	currencyFields.push("service_product_total_price" + servln);
    }
    var f = x.insertCell(6);
    f.innerHTML = "<input type='hidden' name='service_deleted[" + servln + "]' id='service_deleted" + servln + "' value='0'><input type='hidden' name='service_id[" + servln + "]' id='service_id" + servln + "' value=''><button type='button' class='button' id='service_delete_line" + servln + "' value='" + SUGAR.language.get(module_sugar_grp1, 'LBL_REMOVE_PRODUCT_LINE') + "' tabindex='116' onclick='markLineDeleted(" + servln + ",\"service_\")'><img src='themes/default/images/id-ff-clear.png' alt='" + SUGAR.language.get(module_sugar_grp1, 'LBL_REMOVE_PRODUCT_LINE') + "'></button><br>";

    servln++;

    return servln - 1;
}


/**
 * Insert product Header
 */

function insertProductHeader(tableid){
    var module = document.getElementById('_module').value;

    tablehead = document.createElement("thead");
    tablehead.id = tableid +"_head";
    tablehead.style.display="none";
    document.getElementById(tableid).appendChild(tablehead);

    var cellno_row1 = 0;
    var x=tablehead.insertRow(-1);
    x.id='product_head';

    var itm=x.insertCell(cellno_row1);
    itm.innerHTML="Itm";
    itm.style.width="40px";
    cellno_row1++;

    var a=x.insertCell(cellno_row1);
    //a.style.color="rgb(68,68,68)";
    a.innerHTML="Qty";//SUGAR.language.get(module_sugar_grp1, 'LBL_PRODUCT_QUANITY');
    a.style.width="40px";
    cellno_row1++;

    var b=x.insertCell(cellno_row1);
    //b.style.color="rgb(68,68,68)";
    b.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_PRODUCT_NAME');
    b.style.width="240px";
    cellno_row1++;

    var b1=x.insertCell(cellno_row1);
    b1.colSpan = "2";
    //b1.style.color="rgb(68,68,68)";
    b1.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_PART_NUMBER');
    cellno_row1++;

    if(module == 'AOS_Invoices') {
	var b2_1=x.insertCell(cellno_row1);
	//b2_1.style.color="rgb(68,68,68)";
	b2_1.innerHTML='Status';
	cellno_row1++;
    }

    var b2=x.insertCell(cellno_row1);
    //b2.style.color="rgb(68,68,68)";
    b2.innerHTML='License Type';
    cellno_row1++;

    var b3=x.insertCell(cellno_row1);
    //b3.style.color="rgb(68,68,68)";
    b3.innerHTML='Start Date';
    b3.style.width="100px";
    cellno_row1++;

    var b4=x.insertCell(cellno_row1);
    //b4.style.color="rgb(68,68,68)";
    b4.innerHTML='End Date';
    b4.style.width="100px";
    cellno_row1++;

    var c=x.insertCell(cellno_row1);
    //c.style.color="rgb(68,68,68)";
    c.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_LIST_PRICE');
    c.style.width="100px";
    cellno_row1++;

    var d=x.insertCell(cellno_row1);
    //d.style.color="rgb(68,68,68)";
    d.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_DISCOUNT_AMT');
    d.style.width="190px";
    cellno_row1++;

    var e=x.insertCell(cellno_row1);
    //e.style.color="rgb(68,68,68)";
    e.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_UNIT_PRICE');
    cellno_row1++;

    var f=x.insertCell(cellno_row1);
    //f.style.color="rgb(68,68,68)";
    f.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_VAT_AMT');
    f.style.width="190px";
    cellno_row1++;

    var g=x.insertCell(cellno_row1);
    //g.style.color="rgb(68,68,68)";
    g.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_TOTAL_PRICE');
    g.style.width="120px";
    cellno_row1++;

    var h=x.insertCell(cellno_row1);
    //h.style.color="rgb(68,68,68)";
    h.innerHTML='&nbsp;';
}


/**
 * Insert service Header
 */

function insertServiceHeader(tableid){
    tablehead = document.createElement("thead");
    tablehead.id = tableid +"_head";
    tablehead.style.display="none";
    document.getElementById(tableid).appendChild(tablehead);

    var x=tablehead.insertRow(-1);
    x.id='service_head';

    var a=x.insertCell(0);
    a.colSpan = "4";
    //a.style.color="rgb(68,68,68)";
    a.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_SERVICE_NAME');

    var b=x.insertCell(1);
    //b.style.color="rgb(68,68,68)";
    b.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_SERVICE_LIST_PRICE');

    var c=x.insertCell(2);
    //c.style.color="rgb(68,68,68)";
    c.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_SERVICE_DISCOUNT');

    var d=x.insertCell(3);
    //d.style.color="rgb(68,68,68)";
    d.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_SERVICE_PRICE');

    var e=x.insertCell(4);
    //e.style.color="rgb(68,68,68)";
    e.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_VAT_AMT');

    var f=x.insertCell(5);
    //f.style.color="rgb(68,68,68)";
    f.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_TOTAL_PRICE');

    var g=x.insertCell(6);
    //g.style.color="rgb(68,68,68)";
    g.innerHTML='&nbsp;';
}

/**
 * Insert Group
 */

function insertGroup()
{

    if(!enable_groups && groupn > 0){
	return;
    }
    var tableBody = document.createElement("tr");
    tableBody.id = "group_body"+groupn;
    tableBody.className = "group_body";
    document.getElementById('lineItems').appendChild(tableBody);

    var a=tableBody.insertCell(0);
    a.colSpan="100";
    var table = document.createElement("table");
    table.id = "group"+groupn;
    table.className = "group";

    table.style.whiteSpace = 'nowrap';

    //table.width = '950';
    a.appendChild(table);



    tableheader = document.createElement("thead");
    table.appendChild(tableheader);
    var header_row=tableheader.insertRow(-1);


    if(enable_groups){
	var header_cell = header_row.insertCell(0);
	header_cell.scope="row";
	header_cell.colSpan="8";
        header_cell.innerHTML=SUGAR.language.get(module_sugar_grp1, 'LBL_GROUP_NAME')+":&nbsp;&nbsp;<input name='group_name[]' id='"+ table.id +"name'  size='30' maxlength='255'  title='' tabindex='120' type='text' class='group_name'><input type='hidden' name='group_id[]' id='"+ table.id +"id' value=''><input type='hidden' name='group_group_number[]' id='"+ table.id +"group_number' value='"+groupn+"'>";

        var module = document.getElementById('_module').value;
        var disable_freez = '';
        if(module == 'AOS_Quotes') {
            var invoiced = document.getElementById('invoice_status').value;
            if (invoiced == 'Not Invoiced')
                disable_freez = 'disabled readonly';
        }

        var tableFreez = document.createElement("tr");
        var header_cell_freez = tableFreez.insertCell(0);
        header_cell_freez.scope="row";
        header_cell_freez.colSpan="1";
	header_cell_freez.innerHTML="Freeze Prices:&nbsp;&nbsp;<input id='"+ table.id +"freezprice' type='checkbox' " + disable_freez + ">";

        var header_cell_space = tableFreez.insertCell(1);
        header_cell_space.innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;";
	var header_cell_del = tableFreez.insertCell(2);
        header_cell_del.scope="row";
        header_cell_del.colSpan="1";
        header_cell_del.innerHTML="<span title='" + SUGAR.language.get(module_sugar_grp1, 'LBL_DELETE_GROUP') + "' style='float: right;'><a style='cursor: pointer;' id='deleteGroup' tabindex='116' onclick='markGroupDeleted("+groupn+")' class='delete_group'><span class=\"suitepicon suitepicon-action-clear\"></span></a></span><input type='hidden' name='group_deleted[]' id='"+ table.id +"deleted' value='0'>";

        var header_cell_row = header_row.insertCell(1);
        header_cell_row.appendChild(tableFreez);
    }


    var productTableHeader = document.createElement("thead");
    table.appendChild(productTableHeader);
    var productHeader_row=productTableHeader.insertRow(-1);
    var productHeader_cell = productHeader_row.insertCell(0);
    productHeader_cell.colSpan="100";
    var productTable = document.createElement("table");
    productTable.id = "product_group"+groupn;
    productTable.className = "product_group";
    productHeader_cell.appendChild(productTable);

    insertProductHeader(productTable.id);

    var serviceTableHeader = document.createElement("thead");
    table.appendChild(serviceTableHeader);
    var serviceHeader_row=serviceTableHeader.insertRow(-1);
    var serviceHeader_cell = serviceHeader_row.insertCell(0);
    serviceHeader_cell.colSpan="100";
    var serviceTable = document.createElement("table");
    serviceTable.id = "service_group"+groupn;
    serviceTable.className = "service_group";
    serviceHeader_cell.appendChild(serviceTable);

    insertServiceHeader(serviceTable.id);


    tablefooter = document.createElement("tfoot");
    table.appendChild(tablefooter);
    var footer_row=tablefooter.insertRow(-1);
    var footer_cell = footer_row.insertCell(0);
    footer_cell.scope="row";
    footer_cell.colSpan="20";
    footer_cell.innerHTML="<input type='button' tabindex='116' class='button add_product_line' value='"+SUGAR.language.get(module_sugar_grp1, 'LBL_ADD_PRODUCT_LINE')+"' id='"+productTable.id+"addProductLine' onclick='insertProductLine(\""+productTable.id+"\",\""+groupn+"\")' />";
    //footer_cell.innerHTML+=" <input type='button' tabindex='116' class='button' value='"+SUGAR.language.get(module_sugar_grp1, 'LBL_ADD_SERVICE_LINE')+"' id='"+serviceTable.id+"addServiceLine' onclick='insertServiceLine(\""+serviceTable.id+"\",\""+groupn+"\")' />";
    if(enable_groups){
        footer_cell.innerHTML+="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_TOTAL_AMT')+":</label><input name='group_total_amt[]' id='"+ table.id +"total_amt' class='group_total_amt' maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	var footer_row2=tablefooter.insertRow(-1);
	var footer_cell2 = footer_row2.insertCell(0);
	footer_cell2.scope="row";
	footer_cell2.colSpan="20";
	footer_cell2.style="display: none";
        footer_cell2.innerHTML="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_DISCOUNT_AMOUNT')+":</label><input name='group_discount_amount[]' id='"+ table.id +"discount_amount' class='group_discount_amount' maxlength='26' value='' title='' tabindex='120' type='text' readonly></label>";

	var footer_row3=tablefooter.insertRow(-1);
	var footer_cell3 = footer_row3.insertCell(0);
	footer_cell3.scope="row";
	footer_cell3.colSpan="20";
        footer_cell3.innerHTML="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_SUBTOTAL_AMOUNT')+":</label><input name='group_subtotal_amount[]' id='"+ table.id +"subtotal_amount' class='group_subtotal_amount'  maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	var footer_row4=tablefooter.insertRow(-1);
	var footer_cell4 = footer_row4.insertCell(0);
	footer_cell4.scope="row";
	footer_cell4.colSpan="20";
        footer_cell4.innerHTML="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_TAX_AMOUNT')+":</label><input name='group_tax_amount[]' id='"+ table.id +"tax_amount' class='group_tax_amount' maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	if(document.getElementById('subtotal_tax_amount') !== null){
	    var footer_row5=tablefooter.insertRow(-1);
	    var footer_cell5 = footer_row5.insertCell(0);
	    footer_cell5.scope="row";
	    footer_cell5.colSpan="20";
            footer_cell5.innerHTML="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_SUBTOTAL_TAX_AMOUNT')+":</label><input name='group_subtotal_tax_amount[]' id='"+ table.id +"subtotal_tax_amount' class='group_subtotal_tax_amount' maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	    if (typeof currencyFields !== 'undefined'){
		currencyFields.push("" + table.id+ 'subtotal_tax_amount');
	    }
	}

	var footer_row6=tablefooter.insertRow(-1);
	var footer_cell6 = footer_row6.insertCell(0);
	footer_cell6.scope="row";
	footer_cell6.colSpan="20";
        footer_cell6.innerHTML="<span class='totals' style='width:512px'><label>"+SUGAR.language.get(module_sugar_grp1, 'LBL_GROUP_TOTAL')+":</label><input name='group_total_amount[]' id='"+ table.id +"total_amount' class='group_total_amount'  maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	var footer_row7 = tablefooter.insertRow(-1);
	var footer_cell7 = footer_row7.insertCell(0);
	footer_cell7.scope="row";
	footer_cell7.colSpan="20";
	footer_cell7.innerHTML="<span class='totals' style='width:512px'><label>"+"Supplier Total"+":</label><input name='group_total_supplier_amount[]' id='"+ table.id +"total_supplier_amount' class='group_total_amount'  maxlength='26' value='' title='' tabindex='120' type='text' readonly></span>";

	if (typeof currencyFields !== 'undefined'){
	    currencyFields.push("" + table.id+ 'total_amt');
	    currencyFields.push("" + table.id+ 'discount_amount');
	    currencyFields.push("" + table.id+ 'subtotal_amount');
	    currencyFields.push("" + table.id+ 'tax_amount');
	    currencyFields.push("" + table.id+ 'total_amount');
	}
    }
    groupn++;
    return groupn -1;
}

/**
 * Mark Group Deleted
 */

function markGroupDeleted(gn)
{
    document.getElementById('group_body' + gn).style.display = 'none';

    var rows = document.getElementById('group_body' + gn).getElementsByTagName('tbody');

    for (x=0; x < rows.length; x++) {
	var input = rows[x].getElementsByTagName('button');
	for (y=0; y < input.length; y++) {
	    if (input[y].id.indexOf('delete_line') != -1) {
		input[y].click();
	    }
	}
    }

}

/**
 * Mark line deleted
 */

function markLineDeleted(ln, key)
{
    // collapse line; update deleted value
    document.getElementById(key + 'body' + ln).style.display = 'none';
    document.getElementById(key + 'deleted' + ln).value = '1';
    document.getElementById(key + 'delete_line' + ln).onclick = '';
    var groupid = 'group' + document.getElementById(key + 'group_number' + ln).value;

    if(checkValidate('EditView',key+'product_id' +ln)){
	removeFromValidate('EditView',key+'product_id' +ln);
    }

    calculateTotal(groupid);
    calculateTotal();
}

function refreshListPrice() {
    calculateTotal();
}

/**
 * Calculate Line Values
 */

function calculateLine(ln, key, boolsaleprice = true, boollistprice = true, boolenddate = true, boolcost = true, boolquotedcost = true){
    
    if(key == "product_") {
	var module = document.getElementById('_module').value;
	var required = 'product_list_price';

	if(document.getElementById(key + required + ln) === null){
	    required = 'product_unit_price';
	}

	if (document.getElementById(key + 'name' + ln).value === '' || document.getElementById(key + required + ln).value === ''){
	    return;
	}

	var product_name = document.getElementById(key + 'name' + ln).value;
	var license_type = product_name.split(" - ").pop();
	var lictypedate_hidden = document.getElementById("lictypedatehidden").value;

	if(key === "product_" && document.getElementById(key + 'product_qty' + ln) !== null && document.getElementById(key + 'product_qty' + ln).value === ''){
	    document.getElementById(key + 'product_qty' + ln).value =1;
	}

	var productUnitPrice = unformat2Number(document.getElementById(key + 'product_unit_price' + ln).value);
	var cost_2_c = 0;

	if(document.getElementById(key + 'product_list_price' + ln) !== null && document.getElementById(key + 'product_discount' + ln) !== null && document.getElementById(key + 'discount' + ln) !== null){
	    var origProdPrice = get_value(key + 'hidden_orig_prod_price' + ln);
	    var origPrice = get_value(key + 'hidden_orig_price' + ln);
	    var fixPrice = get_value(key + 'hidden_fix_price' + ln);
	    var listPrice = get_value(key + 'hidden_list_price' + ln);
	    var discount = get_value(key + 'product_discount' + ln);
	    var dis = document.getElementById(key + 'discount' + ln).value;

	    var group_rate_id = currency_id_select.options[currency_id_select.selectedIndex].value;
	    group_rate_id = group_rate_id ? group_rate_id : -99;

	    var group_rate = get_rate(group_rate_id);
	    group_rate = isNumeric(group_rate) ? group_rate : 0;

	    var item_rate_id = document.getElementById(key + 'currency' + ln).value;
	    item_rate_id = item_rate_id ? item_rate_id : -99;

	    var item_rate = get_rate(item_rate_id);
	    item_rate = isNumeric(item_rate) ? item_rate : 0;

	    var cost_currency_name = document.getElementById(key + 'cost_currency_c' + ln).value;
	    var cost_currency_symbol = get_cost_currency_symbol(cost_currency_name);
	    var cost_currency_id = get_cost_currency_id(cost_currency_symbol);
	    var cost_rate = isNumeric(get_rate(cost_currency_id)) ? get_rate(cost_currency_id) : 0;

	    if(boolcost) {
		cost_2_c = document.getElementById(key + 'cost_2_c_original' + ln).value;
	    } else {
		cost_2_c = document.getElementById(key + 'cost_2_c' + ln).value;
	    }
	    cost_2_c = removeCurrency(cost_2_c);

	    var days = getDays(ln);
	    var is_ansys = $('#' + key + 'is_ansys' + ln).val();

	    // Base currency is AUD
	    // So if you were converting USD to AUD you’d end up with
	    // AUD $ = USD $ * (USD exhange / AUD exchange)
	    if (license_type == 'Lease' || license_type == 'Maintenance' || license_type == 'Subscription') {
		fixPrice = origProdPrice;
	    } 
	    
	    var new_price = listPrice * (item_rate / group_rate);
	    var fix_new_price = fixPrice * (item_rate / group_rate);

	    //console.log('func:calculateLine = ' + license_type);
	    //console.log('func:calculateLine = boolcost = ' + boolcost);
	    //console.log('func:calculateLine = cost_2_c = ' + cost_2_c);

	    if(boollistprice) {
		listPrice = new_price;
		
		if(boolenddate) {
		    if (license_type == 'Lease') {
			if (is_ansys == 1) {
			    listPrice = computeLeaseAnsys(ln, fix_new_price, days);
			    cost_2_c = computeLeaseAnsys(ln, cost_2_c, days);
			} else {
			    listPrice = computeLeaseNotAnsys(ln, fix_new_price, days);
			    cost_2_c = computeLeaseNotAnsys(ln, cost_2_c, days);
			}
		    }

		    if (license_type == 'Subscription') {
			listPrice = computeLeasePTC(ln, fix_new_price, days);
			cost_2_c = computeLeasePTC(ln, cost_2_c, days);
		    }

		    if (license_type == 'Maintenance') {
			listPrice = computeMaintenance(ln, fix_new_price);
			cost_2_c = computeMaintenance(ln, cost_2_c);
		    }
		}
	    }

	    if(dis == 'Amount')
	    {
		if(discount > listPrice)
		{
		    document.getElementById(key + 'product_discount' + ln).value = listPrice;
		    discount = listPrice;
		}
		productUnitPrice = listPrice - discount;
		if(boolsaleprice) {
		    document.getElementById(key + 'product_unit_price' + ln).value = format2Number(listPrice - discount);
		}
	    }
	    else if(dis == 'Percentage')
	    {
		if(discount > 100)
		{
		    document.getElementById(key + 'product_discount' + ln).value = 100;
		    discount = 100;
		}
		discount = (discount/100) * listPrice;
		productUnitPrice = listPrice - discount;
		
		if(boolsaleprice) {
		    document.getElementById(key + 'product_unit_price' + ln).value = format2Number(listPrice - discount);
		}
	    }
	    else
	    {
		if(boolsaleprice) {
		    document.getElementById(key + 'product_unit_price' + ln).value = document.getElementById(key + 'product_list_price' + ln).value;
		}
		document.getElementById(key + 'product_discount' + ln).value = '';
		discount = 0;
	    }

	    //console.log('listPrice: ' + listPrice)
	    document.getElementById(key + 'product_list_price' + ln).value = format2Number(listPrice);
	    //document.getElementById(key + 'product_discount' + ln).value = format2Number(unformat2Number(document.getElementById(key + 'product_discount' + ln).value));
	    document.getElementById(key + 'product_discount_amount' + ln).value = format2Number(-discount, 6);
	}

	var productQty = 1;
	if(document.getElementById(key + 'product_qty' + ln) !== null){
	    productQty = unformat2Number(document.getElementById(key + 'product_qty' + ln).value);
	    Quantity_format2Number(ln);
	}
	
	if(!boolsaleprice) {
	    productUnitPrice = get_value(key + 'product_unit_price' + ln);
	}

	var vat = unformatNumber(document.getElementById(key + 'vat' + ln).value,',','.');
	var productTotalPrice = productQty * productUnitPrice;
	var totalvat=(productTotalPrice * vat) /100;

	if(total_tax){
	    productTotalPrice=productTotalPrice + totalvat;
	}

	document.getElementById(key + 'vat_amt' + ln).value = format2Number(totalvat);
	if(boolsaleprice) {
	    document.getElementById(key + 'product_unit_price' + ln).value = format2Number(productUnitPrice);
	}
	document.getElementById(key + 'product_total_price' + ln).value = format2Number(productTotalPrice);

	var groupid = 0;
	if(enable_groups){
	    groupid = document.getElementById(key + 'group_number' + ln).value;
	}
	groupid = 'group' + groupid;

	var quoted_cost = 0;
	if(module == 'AOS_Quotes') {
	    var cost_discount = document.getElementById(key + 'cost_discount_c' + ln).value;
	    cost_discount = cost_discount / 100;

	    var supplier_margin = document.getElementById(key + 'supplier_margin_c' + ln).value;
	    supplier_margin = (supplier_margin == "") ? 0 : supplier_margin;

	    //var quoted_cost = unformat2Number(cost_2_c) - (unformat2Number(cost_2_c) * cost_discount);
	    if(boolquotedcost) {
		quoted_cost = (((unformat2Number(cost_2_c) * productQty) * supplier_margin)) - ((((unformat2Number(cost_2_c) * productQty) * supplier_margin)) * cost_discount);
	    } else {
		quoted_cost = unformatNumber(get_value(key + 'supplier_amount_c' + ln));
	    }

	    document.getElementById(key + 'supplier_amount_c' + ln).value = formatNumber(quoted_cost,",",".",2,2);
	}

	var converted_cost = quoted_cost * (cost_rate / group_rate);;

	document.getElementById(key + 'cost_2_c' + ln).value = format2Number(cost_2_c);
	document.getElementById(key + 'cost_2_c_hidden' + ln).value = converted_cost;

	if(module == 'AOS_Quotes') {
	    console.log('productUnitPrice: ' + productUnitPrice);
	    console.log('converted_cost: ' + converted_cost);
	    console.log('quoted_cost: ' + quoted_cost);
	    var margin = (productUnitPrice > 0 && isNumeric(productUnitPrice)) ? ((((productUnitPrice * productQty) - converted_cost) / (productUnitPrice * productQty)) * 100) : 0;
	    //margin = isNumeric(margin) ? (margin < 0 ? '0.00' : margin )  : '0.00';
	    
	    margin = isNumeric(margin) ? format2Number(margin) : '0.00';
	    margin += '%';
	    document.getElementById(key + 'margin' + ln).value = margin;
	}
	
	calculateTotal(groupid);
	calculateTotal();
    }
    
    if(key == "service_") {
	// Original line_item.js
	
	var required = 'product_list_price';
	if(document.getElementById(key + required + ln) === null){
	    required = 'product_unit_price';
	}

	if (document.getElementById(key + 'name' + ln).value === '' || document.getElementById(key + required + ln).value === ''){
	    return;
	}

	if(key === "product_" && document.getElementById(key + 'product_qty' + ln) !== null && document.getElementById(key + 'product_qty' + ln).value === ''){
	    document.getElementById(key + 'product_qty' + ln).value =1;
	}

	var productUnitPrice = unformat2Number(document.getElementById(key + 'product_unit_price' + ln).value);

	if(document.getElementById(key + 'product_list_price' + ln) !== null && document.getElementById(key + 'product_discount' + ln) !== null && document.getElementById(key + 'discount' + ln) !== null){
	    var listPrice = get_value(key + 'product_list_price' + ln);
	    var discount = get_value(key + 'product_discount' + ln);
	    var dis = document.getElementById(key + 'discount' + ln).value;

	    if(dis == 'Amount')
	    {
		if(discount > listPrice)
		{
		    document.getElementById(key + 'product_discount' + ln).value = listPrice;
		    discount = listPrice;
		}
		productUnitPrice = listPrice - discount;
		document.getElementById(key + 'product_unit_price' + ln).value = format2Number(listPrice - discount);
	    }
	    else if(dis == 'Percentage')
	    {
		if(discount > 100)
		{
		    document.getElementById(key + 'product_discount' + ln).value = 100;
		    discount = 100;
		}
		discount = (discount/100) * listPrice;
		productUnitPrice = listPrice - discount;
		document.getElementById(key + 'product_unit_price' + ln).value = format2Number(listPrice - discount);
	    }
	    else
	    {
		document.getElementById(key + 'product_unit_price' + ln).value = document.getElementById(key + 'product_list_price' + ln).value;
		document.getElementById(key + 'product_discount' + ln).value = '';
		discount = 0;
	    }
	    document.getElementById(key + 'product_list_price' + ln).value = format2Number(listPrice);
	    //document.getElementById(key + 'product_discount' + ln).value = format2Number(unformat2Number(document.getElementById(key + 'product_discount' + ln).value));
	    document.getElementById(key + 'product_discount_amount' + ln).value = format2Number(-discount, 6);
	}

	var productQty = 1;
	if(document.getElementById(key + 'product_qty' + ln) !== null){
	    productQty = unformat2Number(document.getElementById(key + 'product_qty' + ln).value);
	    Quantity_format2Number(ln);
	}


	var vat = unformatNumber(document.getElementById(key + 'vat' + ln).value,',','.');

	var productTotalPrice = productQty * productUnitPrice;


	var totalvat=(productTotalPrice * vat) /100;

	if(total_tax){
	    productTotalPrice=productTotalPrice + totalvat;
	}

	document.getElementById(key + 'vat_amt' + ln).value = format2Number(totalvat);

	document.getElementById(key + 'product_unit_price' + ln).value = format2Number(productUnitPrice);
	document.getElementById(key + 'product_total_price' + ln).value = format2Number(productTotalPrice);
	var groupid = 0;
	if(enable_groups){
	    groupid = document.getElementById(key + 'group_number' + ln).value;
	}
	groupid = 'group' + groupid;

	calculateTotal(groupid);
	calculateTotal();
    }
}

function calculateAllLines(){

    var row = document.getElementById('lineItems').getElementsByTagName('tbody');
    var length = row.length;
    for (k=0; k < length; k++) {
	var input = row[k].getElementsByTagName('input');
	var key = input[0].id.split('_')[0]+'_';
	var ln = input[0].id.slice(-1);
	calculateLine(ln, key, true, true, true, true, false);
    }

}

/**
 * Calculate totals
 */
function calculateTotal(key)
{
    if (typeof key === 'undefined') {  key = 'lineItems'; }
    var row = document.getElementById(key).getElementsByTagName('tbody');
    if(key == 'lineItems') key = '';
    var length = row.length;
    var head = {};
    var tot_amt = 0;
    var sale_tot_amt = 0;
    var sale_tot_amt_2 = 0;
    var subtotal = 0;
    var dis_tot = 0;
    var tax = 0;
    var supplier_tot_amt = 0;

    for (i=0; i < length; i++) {
	var qty = 1;
	var list = null;
	var unit = 0;
	var deleted = 0;
	var dis_amt = 0;
	var product_vat_amt = 0;
        var supplier_amt = 0;

	var input = row[i].getElementsByTagName('input');
	for (j=0; j < input.length; j++) {
	    if (input[j].id.indexOf('product_qty') != -1) {
		qty = unformat2Number(input[j].value);
	    }
	    if (input[j].id.indexOf('product_list_price') != -1)
	    {
		list = unformat2Number(input[j].value);
	    }
	    if (input[j].id.indexOf('product_unit_price') != -1)
	    {
		unit = unformat2Number(input[j].value);
	    }
	    if (input[j].id.indexOf('product_discount_amount') != -1)
	    {
		dis_amt = unformat2Number(input[j].value);
	    }
	    if (input[j].id.indexOf('vat_amt') != -1)
	    {
		product_vat_amt = unformat2Number(input[j].value);
	    }
            if (input[j].id.indexOf('product_supplier_amount_c') != -1)
	    {
		supplier_amt = unformat2Number(input[j].value);
	    }
	    if (input[j].id.indexOf('deleted') != -1) {
		deleted = input[j].value;
	    }

	}

	if(deleted != 1 && key !== ''){
	    head[row[i].parentNode.id] = 1;
	} else if(key !== '' && head[row[i].parentNode.id] != 1){
	    head[row[i].parentNode.id] = 0;
	}

	if (qty !== 0 && list !== null && deleted != 1) {
	    tot_amt += list * qty;
	} else if (qty !== 0 && unit !== 0 && deleted != 1) {
	    tot_amt += unit * qty;
	}
	
	if (qty !== 0 && unit !== 0 && deleted != 1) {
	    //tot_amt += unit * qty;
	    sale_tot_amt_2 += unit * qty;
	}
	
	if (dis_amt !== 0 && deleted != 1) {
	    dis_tot += dis_amt * qty;
	}

	if (product_vat_amt !== 0 && deleted != 1) {
	    tax += product_vat_amt;
	}

        if (supplier_amt != 0 && deleted != 1) {
            supplier_tot_amt += supplier_amt;
        }
    }

    for(var h in head){
	if (head[h] != 1 && document.getElementById(h + '_head') !== null) {
	    document.getElementById(h + '_head').style.display = "none";
	}
    }

    //subtotal = tot_amt + dis_tot; //orig

    tot_amt = tot_amt;
    subtotal = sale_tot_amt_2;
    
    set_value(key+'total_amt',tot_amt);
    set_value(key+'subtotal_amount',subtotal);
    set_value(key+'discount_amount',dis_tot);
    set_value(key+'total_supplier_amount', supplier_tot_amt);

    var shipping = get_value(key+'shipping_amount');

    var shippingtax = get_value(key+'shipping_tax');

    var shippingtax_amt = shipping * (shippingtax/100);

    set_value(key+'shipping_tax_amt',shippingtax_amt);

    if(tax != "") {
	tax = parseFloat(tax) + parseFloat(shippingtax_amt);
    }

    set_value(key+'tax_amount',tax);

    set_value(key+'subtotal_tax_amount',subtotal + tax);
    //set_value(key+'total_amount',sale_tot_amt + tax + shipping);
    set_value(key+'total_amount',subtotal + tax + shipping);
}

function set_value(id, value){
    if(document.getElementById(id) !== null)
    {
	document.getElementById(id).value = format2Number(value);
    }
}

function get_value(id){
    if(document.getElementById(id) !== null)
    {
	return unformat2Number(document.getElementById(id).value);
    }
    return 0;
}


function unformat2Number(num)
{
    return unformatNumber(num, num_grp_sep, dec_sep);
}

function format2Number(str, sig)
{
    if (typeof sig === 'undefined') { sig = sig_digits; }
    num = Number(str);
    if(sig == 2){
	str = formatCurrency(num);
    }
    else{
	str = num.toFixed(sig);
    }

    str = str.split(/,/).join('{,}').split(/\./).join('{.}');
    str = str.split('{,}').join(num_grp_sep).split('{.}').join(dec_sep);

    return str;
}

function formatCurrency(strValue)
{
    strValue = strValue.toString().replace(/\$|\,/g,'');
    dblValue = parseFloat(strValue);

    blnSign = (dblValue == (dblValue = Math.abs(dblValue)));
    dblValue = Math.floor(dblValue*100+0.50000000001);
    intCents = dblValue%100;
    strCents = intCents.toString();
    dblValue = Math.floor(dblValue/100).toString();
    if(intCents<10)
	strCents = "0" + strCents;
    for (var i = 0; i < Math.floor((dblValue.length-(1+i))/3); i++)
	dblValue = dblValue.substring(0,dblValue.length-(4*i+3))+','+
	dblValue.substring(dblValue.length-(4*i+3));
    return (((blnSign)?'':'-') + dblValue + '.' + strCents);
}

function Itm_format2Number(ln)
{
    var str = '';
    var qty=unformat2Number(document.getElementById('product_number' + ln).value);
    if(qty === null){
        qty = parseInt(ln) + 1;
    }
    if(qty === 0){
	str = '0';
    } else {
	str = format2Number(qty);
	if(sig_digits){
	    str = str.replace(/0*$/,'');
	    str = str.replace(dec_sep,'~');
	    str = str.replace(/~$/,'');
	    str = str.replace('~',dec_sep);
	}
    }

    document.getElementById('product_number' + ln).value=str;
}

function Quantity_format2Number(ln)
{
    var str = '';
    var qty=unformat2Number(document.getElementById('product_product_qty' + ln).value);
    if(qty === null){qty = 1;}

    if(qty === 0){
	str = '0';
    } else {
	str = format2Number(qty);
	if(sig_digits){
	    str = str.replace(/0*$/,'');
	    str = str.replace(dec_sep,'~');
	    str = str.replace(/~$/,'');
	    str = str.replace('~',dec_sep);
	}
    }

    document.getElementById('product_product_qty' + ln).value=str;
}

function formatNumber(n, num_grp_sep, dec_sep, round, precision) {
    if (typeof num_grp_sep == "undefined" || typeof dec_sep == "undefined") {
	return n;
    }
    if(n === 0) n = '0';

    n = n ? n.toString() : "";
    if (n.split) {
	n = n.split(".");
    } else {
	return n;
    }
    if (n.length > 2) {
	return n.join(".");
    }
    if (typeof round != "undefined") {
	if (round > 0 && n.length > 1) {
	    n[1] = parseFloat("0." + n[1]);
	    n[1] = Math.round(n[1] * Math.pow(10, round)) / Math.pow(10, round);
            if(n[1].toString().includes('.')) {
		n[1] = n[1].toString().split(".")[1];
	    }
	    else {
		n[0] = (parseInt(n[0]) + n[1]).toString();
		n[1] = "";
	    }
	}
	if (round <= 0) {
	    n[0] = Math.round(parseInt(n[0], 10) * Math.pow(10, round)) / Math.pow(10, round);
	    n[1] = "";
	}
    }
    if (typeof precision != "undefined" && precision >= 0) {
	if (n.length > 1 && typeof n[1] != "undefined") {
	    n[1] = n[1].substring(0, precision);
	} else {
	    n[1] = "";
	}
	if (n[1].length < precision) {
	    for (var wp = n[1].length; wp < precision; wp++) {
		n[1] += "0";
	    }
	}
    }
    regex = /(\d+)(\d{3})/;
    while (num_grp_sep !== "" && regex.test(n[0])) {
	n[0] = n[0].toString().replace(regex, "$1" + num_grp_sep + "$2");
    }
    return n[0] + (n.length > 1 && n[1] !== "" ? dec_sep + n[1] : "");
}

function check_form(formname) {
    //calculateAllLines();

    if (typeof(siw) != 'undefined' && siw && typeof(siw.selectingSomething) != 'undefined' && siw.selectingSomething)
	return false;

    return validate_form(formname, '');
}
