package com.project.greenparfum.Config;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;

public class ServerAccess {
    public static final String BASE_URL = "http://greenparfum.site/";
    public static final String STRUK = BASE_URL+"/api/penjualan/getByCode/";
    public static String[] jenis_kelamin = {"Perempuan", "Laki laki"};
    public static String[] status = {"Kurang Sehat", "Normal", "Resiko BB"};


    public static String numberConvert(String val) {
        String format = new DecimalFormat("#,###,###").format(Double.parseDouble(val));
        return "Rp " + format;
    }

}
