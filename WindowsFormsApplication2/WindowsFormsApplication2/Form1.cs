using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

using System.Collections.Specialized;
using System.Net;
using System.IO;




namespace WindowsFormsApplication2
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        //Connection String 
        String connectionString = "server=RAINE-PC;" + "Trusted_Connection=yes;" + "database=JT_ERP;" + "connection timeout=30";
        //Connection String

        private void button1_Click(object sender, EventArgs e)
        {

            SqlConnection con = new SqlConnection();
            con.ConnectionString = connectionString;

            try {
                con.Open();

                progressBar1.Maximum = 10000;

                for (int num = 0; num <= 10000; num++) {
                    System.Data.SqlClient.SqlCommand command = new System.Data.SqlClient.SqlCommand();
                    command.CommandType = System.Data.CommandType.Text;
                    command.CommandText = "INSERT INTO dbo.rain_table(data) VALUES('Raineir John Serinas " + num + "')";
                    command.Connection = con;
                    command.ExecuteNonQuery();

                    progressBar1.Value = num;

                    String insertVal = "Raineir John Serinas " + num;
                    label1.Text = insertVal;
                    Application.DoEvents();
                    if (num == 10000) {
                        MessageBox.Show("100%");
                        con.Close();
                    }
                }
            }catch (Exception exp) {
                MessageBox.Show(exp.ToString());
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {

            string URL = "http://mark.journeytech.com.ph/reports_new/test.php";
            WebClient webClient = new WebClient();

            NameValueCollection formData = new NameValueCollection();

            byte[] responseBytes = webClient.UploadValues(URL, "POST", formData);
            string responsefromserver = Encoding.UTF8.GetString(responseBytes);
            MessageBox.Show(responsefromserver);
            webClient.Dispose();
        }


    }
}
