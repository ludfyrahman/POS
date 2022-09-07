package com.project.greenparfum;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.app.AlertDialog;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.hardware.usb.UsbDevice;
import android.hardware.usb.UsbManager;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.dantsu.escposprinter.EscPosPrinter;
import com.dantsu.escposprinter.EscPosPrinterSize;
import com.dantsu.escposprinter.connection.DeviceConnection;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothConnection;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothPrintersConnections;
import com.dantsu.escposprinter.connection.tcp.TcpConnection;
import com.dantsu.escposprinter.connection.usb.UsbConnection;
import com.dantsu.escposprinter.connection.usb.UsbPrintersConnections;
import com.dantsu.escposprinter.exceptions.EscPosBarcodeException;
import com.dantsu.escposprinter.exceptions.EscPosConnectionException;
import com.dantsu.escposprinter.exceptions.EscPosEncodingException;
import com.dantsu.escposprinter.exceptions.EscPosParserException;
import com.dantsu.escposprinter.textparser.PrinterTextParserImg;
import com.project.greenparfum.Config.AppController;
import com.project.greenparfum.Config.ServerAccess;
import com.project.greenparfum.Model.StrukModel;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import com.project.greenparfum.async.AsyncBluetoothEscPosPrint;
import com.project.greenparfum.async.AsyncEscPosPrinter;
import com.project.greenparfum.async.AsyncTcpEscPosPrint;
import com.project.greenparfum.async.AsyncUsbEscPosPrint;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class Print extends AppCompatActivity {
    private static final String ACTION_USB_PERMISSION = "com.android.example.USB_PERMISSION";
    public static final int PERMISSION_BLUETOOTH = 1;
    String alamat;
    String kasir;
    String kembalian;
    /* access modifiers changed from: private */
    public List<StrukModel> list;
    String no_telp;

    /* renamed from: pd */
    ProgressDialog pd;
    String pembayaran;
    /* access modifiers changed from: private */
    public BluetoothConnection selectedDevice;
    Button show;
    String tanggal_trasaksi;
    String toko;
    String total_transaksi;
    private final BroadcastReceiver usbReceiver = new BroadcastReceiver() {
        public void onReceive(Context context, Intent intent) {
            if (Print.ACTION_USB_PERMISSION.equals(intent.getAction())) {
                synchronized (this) {
                    UsbManager usbManager = (UsbManager) getSystemService(Context.USB_SERVICE);
                    UsbDevice usbDevice = (UsbDevice) intent.getParcelableExtra("device");
                    if (!(!intent.getBooleanExtra("permission", false) || usbManager == null || usbDevice == null)) {
                        new AsyncUsbEscPosPrint(context).execute(new AsyncEscPosPrinter[]{Print.this.getAsyncEscPosPrinter(new UsbConnection(usbManager, usbDevice))});
                    }
                }
            }
        }
    };
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_print);
    }

    /* access modifiers changed from: private */
    public void show() {
        for (int i = 0; i < this.list.size(); i++) {
            Log.d("data", this.list.get(i).getNama());
        }
    }

    private void loadJson() {
        pd.setMessage("Menampilkan Data");
        pd.setCancelable(false);
        pd.show();
        Intent data = getIntent();
        String url = ServerAccess.STRUK + data.getStringExtra("id");
        Log.d("url", url);
        AppController.getInstance().addToRequestQueue(new StringRequest(0, url, new Response.Listener<String>() {
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONArray arr = res.getJSONArray("detail_transaksi");
                    JSONObject t = res.getJSONObject("transaksi");
                    toko = t.getString("toko");
                    tanggal_trasaksi = t.getString("tanggal_transaksi");
                    pembayaran = t.getString("bayar");
                    kembalian = t.getString("kembalian");
                    alamat = t.getString("alamat");
                    no_telp = t.getString("no_telp");
                    kasir = t.getString("kasir");
                    total_transaksi = t.getString("total_transaksi");
                    if (arr.length() > 0) {
                        pd.cancel();
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject data = arr.getJSONObject(i);
                                StrukModel md = new StrukModel();
                                md.setKode(data.getString("id"));
                                md.setJumlah(data.getString("jumlah"));
                                md.setSubtotal(data.getString("subtotal"));
                                md.setNama(data.getString("produk"));
                                md.setHarga(data.getString("harga"));
                                list.add(md);
                            } catch (Exception ea) {
                                ea.printStackTrace();
                            }
                        }
                        return;
                    }
                    pd.cancel();
                    Toast.makeText(getBaseContext(), "Data Kosong",Toast.LENGTH_SHORT).show();
                } catch (JSONException e) {
                    pd.cancel();
                    Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            public void onErrorResponse(VolleyError error) {
                pd.cancel();
                Log.d("volley", "errornya : " + error.getMessage());
            }
        }));
    }
    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (grantResults.length > 0 && grantResults[0] == 0 && requestCode == 1) {
            printBluetooth();
        }
    }



    public void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList = new BluetoothPrintersConnections().getList();
        if (bluetoothDevicesList != null) {
            final String[] items = new String[(bluetoothDevicesList.length + 1)];
            items[0] = "Default printer";
            int i = 0;
            for (BluetoothConnection device : bluetoothDevicesList) {
                i++;
                items[i] = device.getDevice().getName();
            }
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Bluetooth printer selection");
            alertDialog.setItems(items, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialogInterface, int i) {
                    int index = i - 1;
                    if (index == -1) {
                        BluetoothConnection unused = selectedDevice = null;
                    } else {
                        BluetoothConnection unused2 = selectedDevice = bluetoothDevicesList[index];
                    }
                    ((Button) findViewById(R.id.button_bluetooth_browse)).setText(items[i]);
                }
            });
            AlertDialog alert = alertDialog.create();
            alert.setCanceledOnTouchOutside(false);
            alert.show();
        }
    }

    public void printBluetooth() {
        if (ContextCompat.checkSelfPermission(this, "android.permission.BLUETOOTH") != 0) {
            ActivityCompat.requestPermissions(this, new String[]{"android.permission.BLUETOOTH"}, 1);
            return;
        }
        new AsyncBluetoothEscPosPrint(this).execute(new AsyncEscPosPrinter[]{getAsyncEscPosPrinter(this.selectedDevice)});
    }

    public void printUsb() {
        UsbConnection usbConnection = UsbPrintersConnections.selectFirstConnected(this);
        UsbManager usbManager = (UsbManager) getSystemService(Context.USB_SERVICE);
        if (usbConnection == null || usbManager == null) {
            new AlertDialog.Builder(this).setTitle("USB Connection").setMessage("No USB printer found.").show();
            return;
        }
        PendingIntent permissionIntent = PendingIntent.getBroadcast(this, 0, new Intent(ACTION_USB_PERMISSION), 0);
        registerReceiver(this.usbReceiver, new IntentFilter(ACTION_USB_PERMISSION));
        usbManager.requestPermission(usbConnection.getDevice(), permissionIntent);
    }

    public void printTcp() {
        EditText ipAddress = (EditText) findViewById(R.id.edittext_tcp_ip);
        EditText portAddress = (EditText) findViewById(R.id.edittext_tcp_port);
        try {
            new AsyncTcpEscPosPrint(this).execute(new AsyncEscPosPrinter[]{getAsyncEscPosPrinter(new TcpConnection(ipAddress.getText().toString(), Integer.parseInt(portAddress.getText().toString())))});
        } catch (NumberFormatException e) {
            new AlertDialog.Builder(this).setTitle("Invalid TCP port address").setMessage("Port field must be a number.").show();
            e.printStackTrace();
        }
    }

    public void printIt(DeviceConnection printerConnection) {
        try {
            SimpleDateFormat format = new SimpleDateFormat("'on' yyyy-MM-dd 'at' HH:mm:ss");
            EscPosPrinter printer = new EscPosPrinter(printerConnection, 203, 48.0f, 32);
            printer.printFormattedText("[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString((EscPosPrinterSize) printer, getApplicationContext().getResources().getDrawableForDensity(R.drawable.logo, 160)) + "</img>\n[L]\n[C]<u><font size='big'>ORDER N°045</font></u>\n[L]\n[C]<u type='double'>" + format.format(new Date()) + "</u>\n[C]\n[C]================================\n[L]\n[L]<b>BEAUTIFUL SHIRT</b>[R]9.99€\n[L]  + Size : S\n[L]\n[C]--------------------------------\n[R]TOTAL PRICE :[R]34.98€\n[R]TAX :[R]4.23€\n[L]\n[C]================================\n[L]\n[L]<u><font color='bg-black' size='tall'>Customer :</font></u>\n[L]Raymond DUPONT\n[L]5 rue des girafes\n[L]31547 PERPETES\n[L]Tel : +33801201456\n\n[L]\n[C]<qrcode size='20'>http://www.developpeur-web.dantsu.com/</qrcode>\n");
        } catch (EscPosConnectionException e) {
            e.printStackTrace();
            new AlertDialog.Builder(this).setTitle("Broken connection").setMessage(e.getMessage()).show();
        } catch (EscPosParserException e2) {
            e2.printStackTrace();
            new AlertDialog.Builder(this).setTitle("Invalid formatted text").setMessage(e2.getMessage()).show();
        } catch (EscPosEncodingException e3) {
            e3.printStackTrace();
            new AlertDialog.Builder(this).setTitle("Bad selected encoding").setMessage(e3.getMessage()).show();
        } catch (EscPosBarcodeException e4) {
            e4.printStackTrace();
            new AlertDialog.Builder(this).setTitle("Invalid barcode").setMessage(e4.getMessage()).show();
        }
    }

    public AsyncEscPosPrinter getAsyncEscPosPrinter(DeviceConnection printerConnection) {
        new SimpleDateFormat("'on' yyyy-MM-dd 'at' HH:mm:ss");
        AsyncEscPosPrinter printer = new AsyncEscPosPrinter(printerConnection, 203, 48.0f, 32);
        String header = "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString((EscPosPrinterSize) printer, getApplicationContext().getResources().getDrawableForDensity(R.drawable.logo, 160)) + "</img>\n[L]\n[C]<u>" + this.toko + "</u>\n[C]<u>" + this.alamat + "</u>\n[C]<u>" + this.no_telp + "</u>\n[L]\n[C]<u type='double'>" + this.tanggal_trasaksi + "</u>\n[C]\n[C]================================\n";
        String product = "";
        for (int i = 0; i < this.list.size(); i++) {
            product = product + "[L]<b>" + this.list.get(i).getNama() + "(" + ServerAccess.numberConvert(this.list.get(i).getHarga()) + ")</b>[R]" + ServerAccess.numberConvert(this.list.get(i).getSubtotal()) + "\n[L]  + Qty : " + this.list.get(i).getJumlah() + "\n[L]\n";
        }
        return printer.addTextToPrint(header + (product + "[C]--------------------------------\n[R]Total  :[R]" + ServerAccess.numberConvert(this.total_transaksi) + "\n[R]Tunai  :[R]" + ServerAccess.numberConvert(this.pembayaran) + "\n[R]Kembalian  :[R]" + ServerAccess.numberConvert(this.kembalian) + "\n[L]\n[C]================================\n") + ("[L]\n[L]<u>Kasir:</font></u>\n[L]" + this.kasir + "\n[L]\n"));
    }
}