using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using OOProject.CLASS;

namespace OOProject.FORM
{
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        Class_1 c = new Class_1();

        private void button1_Click(object sender, EventArgs e)
        {
            int num1 = 1;
            int num2 = 10;
            MessageBox.Show(c.number(num1, num2).ToString());
        }
    }
}
