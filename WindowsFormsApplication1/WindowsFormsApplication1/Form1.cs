using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;
using System.Data.SqlClient;

namespace WindowsFormsApplication1
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

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            String destination;
            String Message;

            destination = textBox1.Text;
            Message = textBox2.Text;

            //FileStream fs1 = new FileStream(destination, FileMode.OpenOrCreate, FileAccess.Write);
            //StreamWriter writer = new StreamWriter(fs1);
            //writer.Write(Message);
            //writer.Close();


            if (File.Exists(destination)){
                File.Delete(destination);
                MessageBox.Show("File Succesfully Deleted!", "Warning", MessageBoxButtons.OK);
            }else {
                MessageBox.Show("File cannot be found. Delete Failed");
            }

            textBox1.Text = "";
            textBox2.Text = "";
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {

                SqlConnection con = new SqlConnection();
                con.ConnectionString = connectionString;

                String name;
                name = textBox1.Text;

                try{
                    con.Open();

                    System.Data.SqlClient.SqlCommand cmd = new System.Data.SqlClient.SqlCommand();
                    cmd.CommandType = System.Data.CommandType.Text;
                    cmd.CommandText = "INSERT INTO dbo.rain_table(data) VALUES('"+name+ "')";
                    cmd.Connection = con;
                    cmd.ExecuteNonQuery();
                    con.Close();

                    MessageBox.Show("Well done!");
                }catch (Exception exp) {

                    MessageBox.Show("Insert Failed");

                }//End try catch
                    
        }


    }
}
