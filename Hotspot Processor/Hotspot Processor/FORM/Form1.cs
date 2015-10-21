using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Collections.Specialized;
using System.Net;
using System.IO;


namespace Hotspot_Processor.FORM
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private bool stop = false;

        private void button1_Click(object sender, EventArgs e)
        {
            if (stop == false)
            {
                timer1.Start();
            }
            label6.Visible = true;
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            if (stop == false) {
                execute_command();
            }
        }


        private void execute_command()
        {

            /*string URL = "http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Active/hotspot_final.php";
            WebClient webClient = new WebClient();
            NameValueCollection formData = new NameValueCollection();
            byte[] responseBytes = webClient.UploadValues(URL, "POST", formData);
            string responsefromserver = Encoding.UTF8.GetString(responseBytes);
            textBox1.Text = responsefromserver;
            webClient.Dispose();*/

            /*
            string URL1 = "http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Bus/hotspot_final.php";
            WebClient webClient1 = new WebClient();
            NameValueCollection formData1 = new NameValueCollection();
            byte[] responseBytes1 = webClient1.UploadValues(URL1, "POST", formData1);
            string responsefromserver1 = Encoding.UTF8.GetString(responseBytes1);
            textBox2.Text = responsefromserver1;
            webClient1.Dispose();
            

            string URL2 = "http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Trans/hotspot_final.php";
            WebClient webClient2 = new WebClient();
            NameValueCollection formData2 = new NameValueCollection();
            byte[] responseBytes2 = webClient2.UploadValues(URL2, "POST", formData2);
            string responsefromserver2 = Encoding.UTF8.GetString(responseBytes2);
            textBox3.Text = responsefromserver2;
            webClient2.Dispose();
            

            string URL3 = "http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Fast/hotspot_final.php";
            WebClient webClient3 = new WebClient();
            NameValueCollection formData3 = new NameValueCollection();
            byte[] responseBytes3 = webClient3.UploadValues(URL3, "POST", formData3);
            string responsefromserver3 = Encoding.UTF8.GetString(responseBytes3);
            textBox4.Text = responsefromserver3;
            webClient3.Dispose();
           

            string URL4 = "http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Passive/hotspot_final.php";
            WebClient webClient4 = new WebClient();
            NameValueCollection formData4 = new NameValueCollection();
            byte[] responseBytes4 = webClient4.UploadValues(URL4, "POST", formData4);
            string responsefromserver4 = Encoding.UTF8.GetString(responseBytes4);
            textBox5.Text = responsefromserver4;
            webClient4.Dispose();
            Application.DoEvents();*/

            var webClient1 = new WebClient();
            textBox1.Text = webClient1.DownloadString("http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Active/hotspot_final.php");

            var webClient2 = new WebClient();
            textBox2.Text = webClient2.DownloadString("http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Bus/hotspot_final.php");

            var webClient3 = new WebClient();
            textBox3.Text = webClient3.DownloadString("http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Trans/hotspot_final.php");

            var webClient4 = new WebClient();
            textBox4.Text = webClient4.DownloadString("http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Fast/hotspot_final.php");

            var webClient5 = new WebClient();
            textBox5.Text = webClient5.DownloadString("http://mark.journeytech.com.ph/hotspot_processor/Hotspot_batch2_Passive/hotspot_final.php");

            Application.DoEvents();

            // MessageBox.Show("Test");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            stop = true;
            label7.Visible = true;
            label6.Visible = false;
        }
    }
}
