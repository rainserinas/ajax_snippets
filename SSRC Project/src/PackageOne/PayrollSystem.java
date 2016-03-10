package PackageOne;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JDesktopPane;
import javax.swing.JMenuBar;
import javax.swing.JMenu;
import javax.swing.JMenuItem;

import java.awt.CardLayout;

import javax.swing.AbstractButton;
import javax.swing.JInternalFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;
import javax.swing.JLayeredPane;
import javax.swing.JPanel;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

import javax.swing.JCheckBox;

import java.awt.BorderLayout;

import javax.swing.border.SoftBevelBorder;
import javax.swing.border.BevelBorder;
import javax.swing.border.LineBorder;

import java.awt.Color;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import javax.swing.border.TitledBorder;
import javax.swing.UIManager;
import javax.swing.JSeparator;

import com.toedter.calendar.JDateChooser;

public class PayrollSystem {

	private JFrame frmJpayrollsystemV;
	private JPanel panel;
	private JPanel panel_1;
	private JTextField textField;
	private JMenuItem mntmLogout;
	private JMenuItem mntmLogIn;
	private JInternalFrame internalFrame;
	private JMenu mnRecords;
	private JMenu mnPayroll;
	private JMenu mnAbout;
	private JButton btnUpdate;
	private JButton btnSaveUpdate;
	private JButton btnNext;
	
	DBconnection dbconn = new DBconnection();

	PreparedStatement pst = null;
	ResultSet rs1,rs, searchrs = null;
	Statement st, searchst;
	Connection searchcon;
	
	private JPasswordField passwordField;
	private JTextField textField_1;
	private JTextField textField_2;
	private JTextField textField_3;
	private JTextField textField_4;
	private JTextField textField_5;
	private JComboBox comboBox;
	private JComboBox comboBox_1;
	private JComboBox comboBox_2;
	private JComboBox comboBox_3;
	private JTextField textField_6;
	private JPanel panel_2;
	private JTextField textField_7;
	private JTextField textField_8;
	private JTextField textField_9;
	private JTextField textField_10;
	private JTextField textField_11;
	private JTextField textField_12;
	private JTextField textField_13;
	private JTextField textField_14;
	private JTextField textField_16;
	private JTextField textField_17;
	private JTextField textField_18;
	private JTextField textField_19;
	private JTextField textField_20;
	private JTextField textField_23;
	private JTextField textField_21;
	private JTextField textField_22;
	private JTextField textField_24;
	private JTextField textField_25;
	private JTextField textField_26;
	private JTextField textField_27;
	private JPanel panel_3;
	private JTextField textField_28;
	private JTextField textField_29;
	private JTextField textField_30;
	private JTextField textField_31;
	private JTextField textField_32;
	private JTextField textField_33;
	private JTextField textField_34;
	private double gp;
	private double totalDeduction;
	private JDateChooser dateChooser;
	private JTextField textField_38;
	private JTextField textField_39;
	private JDateChooser dateChooser_1;
	private JPanel panel_8;
	

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					PayrollSystem window = new PayrollSystem();
					window.frmJpayrollsystemV.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public PayrollSystem() {
		initialize();
		DBconnection dbconn = new DBconnection();
		putdata();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmJpayrollsystemV = new JFrame();
		frmJpayrollsystemV.setTitle("JPayroll-System v1.0");
		frmJpayrollsystemV.setResizable(false);
		frmJpayrollsystemV.setBounds(100, 100, 757, 514);
		frmJpayrollsystemV.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmJpayrollsystemV.getContentPane().setLayout(new CardLayout(0, 0));
		
		panel = new JPanel();
		frmJpayrollsystemV.getContentPane().add(panel, "name_6169108087072");
		panel.setLayout(null);
		
		internalFrame = new JInternalFrame("Login Form");
		internalFrame.setMaximizable(true);
		internalFrame.setIconifiable(true);
		internalFrame.setDefaultCloseOperation(JFrame.HIDE_ON_CLOSE);
		internalFrame.setClosable(true);
		internalFrame.setBounds(127, 81, 384, 231);
		panel.add(internalFrame);
		internalFrame.getContentPane().setLayout(null);
		
		
		JLabel lblUsername = new JLabel("Username:");
		lblUsername.setBounds(61, 49, 95, 32);
		internalFrame.getContentPane().add(lblUsername);
		
		textField = new JTextField();
		textField.setBounds(129, 55, 145, 20);
		internalFrame.getContentPane().add(textField);
		textField.setColumns(10);
		
		JLabel lblPassword = new JLabel("Password:");
		lblPassword.setBounds(61, 92, 95, 32);
		internalFrame.getContentPane().add(lblPassword);
		
		JButton btnSubmit = new JButton("Submit");
		btnSubmit.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
		
				try{
					String sql = "SELECT * FROM auth_table WHERE username=? and password=?";
					pst = dbconn.con.prepareStatement(sql);
					pst.setString(1, textField.getText());
					pst.setString(2, passwordField.getText());
					rs1 = pst.executeQuery();
					
					if(rs1.next()){
						JOptionPane.showMessageDialog(null, "Login successful! Welcome " + textField.getText().toUpperCase() + "!");
						internalFrame.setVisible(false);
						textField.setText("");
						passwordField.setText("");
						
						
						mnRecords.setEnabled(true);
						mnPayroll.setEnabled(true);
						mnAbout.setEnabled(true);
						
						
						
						
						
					}else{
						JOptionPane.showMessageDialog(null, "Incorrect username or password!");
					}
					
					
					
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp);
				}
			
			
			
			}
		});
		btnSubmit.setBounds(154, 129, 89, 23);
		internalFrame.getContentPane().add(btnSubmit);
		
		passwordField = new JPasswordField();
		passwordField.setBounds(129, 98, 145, 20);
		internalFrame.getContentPane().add(passwordField);
		
		panel_1 = new JPanel();
		panel_1.setVisible(false);
		frmJpayrollsystemV.getContentPane().add(panel_1, "name_6175903313107");
		panel_1.setLayout(null);
		panel_1.setVisible(false);
		
		JLabel lblFirstName = new JLabel("First name :");
		lblFirstName.setBounds(10, 52, 67, 28);
		panel_1.add(lblFirstName);
		
		textField_1 = new JTextField();
		textField_1.setBounds(87, 56, 120, 20);
		panel_1.add(textField_1);
		textField_1.setColumns(10);
		
		textField_2 = new JTextField();
		textField_2.setBounds(87, 95, 120, 20);
		panel_1.add(textField_2);
		textField_2.setColumns(10);
		
		JLabel lblLastName = new JLabel("Last name:");
		lblLastName.setBounds(10, 91, 67, 28);
		panel_1.add(lblLastName);
		
		JLabel lblPosition = new JLabel("Position:");
		lblPosition.setBounds(10, 124, 67, 28);
		panel_1.add(lblPosition);
		
		textField_3 = new JTextField();
		textField_3.setBounds(87, 128, 120, 20);
		panel_1.add(textField_3);
		textField_3.setColumns(10);
		
		JLabel lblDepartment = new JLabel("Department:");
		lblDepartment.setBounds(10, 158, 81, 28);
		panel_1.add(lblDepartment);
		
		textField_4 = new JTextField();
		textField_4.setBounds(87, 162, 120, 20);
		panel_1.add(textField_4);
		textField_4.setColumns(10);
		
		JPanel panel_4 = new JPanel();
		panel_4.setBorder(new TitledBorder(UIManager.getBorder("TitledBorder.border"), "Date hired", TitledBorder.LEADING, TitledBorder.TOP, null, new Color(0, 0, 0)));
		panel_4.setBounds(17, 207, 372, 51);
		panel_1.add(panel_4);
		panel_4.setLayout(null);
		
		JLabel lblMonth = new JLabel("Month:");
		lblMonth.setBounds(6, 16, 67, 28);
		panel_4.add(lblMonth);
		
		comboBox = new JComboBox();
		comboBox.setBounds(49, 20, 92, 20);
		panel_4.add(comboBox);
		comboBox.setModel(new DefaultComboBoxModel(new String[] {"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"}));
		
		JLabel lblDay = new JLabel("Date:");
		lblDay.setBounds(151, 23, 46, 14);
		panel_4.add(lblDay);
		
		comboBox_1 = new JComboBox();
		comboBox_1.setBounds(187, 20, 46, 20);
		panel_4.add(comboBox_1);
		comboBox_1.setModel(new DefaultComboBoxModel(new String[] {"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"}));
		
		JLabel lblYear = new JLabel("Year:");
		lblYear.setBounds(243, 23, 46, 14);
		panel_4.add(lblYear);
		
		comboBox_2 = new JComboBox();
		comboBox_2.setBounds(299, 20, 67, 20);
		panel_4.add(comboBox_2);
		comboBox_2.setModel(new DefaultComboBoxModel(new String[] {"2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020"}));
		
		JLabel lblStatus = new JLabel("Status:");
		lblStatus.setBounds(243, 124, 46, 28);
		panel_1.add(lblStatus);
		
		comboBox_3 = new JComboBox();
		comboBox_3.setModel(new DefaultComboBoxModel(new String[] {"Probitionary", "Casual", "Contractual", "Regular", "Terminated", "Resigned"}));
		comboBox_3.setBounds(295, 128, 94, 20);
		panel_1.add(comboBox_3);
		
		JLabel lblMonthlySalary = new JLabel("Monthly Salary:");
		lblMonthlySalary.setBounds(243, 162, 94, 21);
		panel_1.add(lblMonthlySalary);
		
		textField_5 = new JTextField();
		textField_5.setBounds(336, 162, 120, 20);
		panel_1.add(textField_5);
		textField_5.setColumns(10);
		
		JButton btnSave = new JButton("Save");
		btnSave.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
			
				try{
					
					int updateconfirm = JOptionPane.showConfirmDialog(null, "Are you sure to update?", "Update Confirm", JOptionPane.YES_NO_OPTION, JOptionPane.WARNING_MESSAGE);
					
					if(updateconfirm == JOptionPane.YES_OPTION){
					
					st = dbconn.con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
					String sql = "SELECT * FROM employee_records";
					rs = st.executeQuery(sql);
					
					
					rs.last();
					rs.moveToInsertRow();
					
					rs.updateString("emp_id", textField_14.getText());
					rs.updateString("firstname", textField_1.getText());
					rs.updateString("lastname", textField_2.getText());
					rs.updateString("position", textField_3.getText());
					rs.updateString("department", textField_4.getText());
					
					//combo box
					
					String month = (String) comboBox.getSelectedItem();
					
					String monthNum = "";
					
					switch(month){
					
					case "January":
						monthNum = "01";
						break;
					case "February":
						monthNum = "02";
						break;
					case "March":
						monthNum ="03";
						break;
					case "April":
						monthNum = "04";
						break;
					case "May":
						monthNum = "05";
						break;
					case "June":
						monthNum = "06";
						break;
					case "July":
						monthNum = "07";
						break;
					case "August":
						monthNum = "08";
						break;
					case "September":
						monthNum = "09";
						break;
					case "October":
						monthNum = "10";
						break;
					case "November":
						monthNum = "11";
						break;
					case "December":
						monthNum = "12";
						break;	
					
					}
					
					String datehired = (String) comboBox_1.getSelectedItem();
					String yearhired = (String) comboBox_2.getSelectedItem();
					
					rs.updateString("date_hired", monthNum+ "/"+datehired+ "/" +yearhired);
					
					String status = (String) comboBox_3.getSelectedItem();
					
					rs.updateString("status", status);
					rs.updateInt("monthly_salary", Integer.parseInt(textField_5.getText()));
					
					rs.insertRow();
					//dbconn.con.commit();
					//nagkaron ng problem sa autocommit=true kaya naka comment out yung commit()
					/*rs.close();
					st.close();
					dbconn.con.close();*/
					
					JOptionPane.showMessageDialog(null, "Add new employee successful!");
					
					textField_14.setText("");
					textField_1.setText("");
					textField_2.setText("");
					textField_3.setText("");
					textField_4.setText("");
					textField_5.setText("");
					rs.first();
					}
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp);
				}
			
			
			}
		});
		btnSave.setBounds(173, 269, 89, 23);
		panel_1.add(btnSave);
		
		JButton btnCancel = new JButton("Cancel");
		btnCancel.setBounds(272, 269, 89, 23);
		panel_1.add(btnCancel);
		
		JLabel lblEmployeeId_1 = new JLabel("Employee ID:");
		lblEmployeeId_1.setBounds(10, 13, 81, 28);
		panel_1.add(lblEmployeeId_1);
		
		textField_14 = new JTextField();
		textField_14.setBounds(87, 17, 120, 20);
		panel_1.add(textField_14);
		textField_14.setColumns(10);
		
		panel_2 = new JPanel();
		frmJpayrollsystemV.getContentPane().add(panel_2, "name_1561008102140");
		panel_2.setLayout(null);
		
		textField_6 = new JTextField();
		textField_6.setEditable(false);
		textField_6.setBounds(108, 53, 150, 26);
		panel_2.add(textField_6);
		textField_6.setColumns(10);
		
		
		JLabel lblFirstName_1 = new JLabel("First name:");
		lblFirstName_1.setBounds(26, 49, 91, 35);
		panel_2.add(lblFirstName_1);
		
		JLabel lblLastName_1 = new JLabel("Last name:");
		lblLastName_1.setBounds(26, 90, 91, 35);
		panel_2.add(lblLastName_1);
		
		textField_7 = new JTextField();
		textField_7.setEditable(false);
		textField_7.setBounds(108, 94, 150, 26);
		panel_2.add(textField_7);
		textField_7.setColumns(10);
		
		JLabel lblPosition_1 = new JLabel("Position:");
		lblPosition_1.setBounds(26, 131, 91, 35);
		panel_2.add(lblPosition_1);
		
		textField_8 = new JTextField();
		textField_8.setEditable(false);
		textField_8.setBounds(108, 136, 150, 26);
		panel_2.add(textField_8);
		textField_8.setColumns(10);
		
		JLabel lblDepartment_1 = new JLabel("Department:");
		lblDepartment_1.setBounds(26, 177, 91, 35);
		panel_2.add(lblDepartment_1);
		
		textField_9 = new JTextField();
		textField_9.setEditable(false);
		textField_9.setBounds(108, 176, 150, 26);
		panel_2.add(textField_9);
		textField_9.setColumns(10);
		
		JLabel lblDateHired = new JLabel("Date Hired:");
		lblDateHired.setBounds(26, 213, 91, 35);
		panel_2.add(lblDateHired);
		
		textField_10 = new JTextField();
		textField_10.setEditable(false);
		textField_10.setBounds(108, 217, 150, 26);
		panel_2.add(textField_10);
		textField_10.setColumns(10);
		
		JLabel lblmmddyyy = new JLabel("(mm/dd/yyyy)");
		lblmmddyyy.setBounds(268, 217, 101, 26);
		panel_2.add(lblmmddyyy);
		
		JLabel lblStatus_1 = new JLabel("Status:");
		lblStatus_1.setBounds(26, 254, 91, 35);
		panel_2.add(lblStatus_1);
		
		textField_11 = new JTextField();
		textField_11.setEditable(false);
		textField_11.setBounds(108, 258, 150, 26);
		panel_2.add(textField_11);
		textField_11.setColumns(10);
		
		JLabel lblMontlySalary = new JLabel("Montly Salary:");
		lblMontlySalary.setBounds(26, 295, 91, 35);
		panel_2.add(lblMontlySalary);
		
		textField_12 = new JTextField();
		textField_12.setEditable(false);
		textField_12.setBounds(108, 300, 150, 26);
		panel_2.add(textField_12);
		textField_12.setColumns(10);
		
		JLabel lblEmployeeId = new JLabel("Employee ID:");
		lblEmployeeId.setBounds(26, 11, 91, 35);
		panel_2.add(lblEmployeeId);
		
		textField_13 = new JTextField();
		textField_13.setEditable(false);
		textField_13.setBounds(108, 15, 79, 26);
		panel_2.add(textField_13);
		textField_13.setColumns(10);
		
		JButton btnPrevious = new JButton("Previous");
		btnPrevious.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				textField_6.setEditable(false);
				textField_7.setEditable(false);
				textField_8.setEditable(false);
				textField_9.setEditable(false);
				textField_10.setEditable(false);
				textField_11.setEditable(false);
				textField_12.setEditable(false);
				textField_38.setEditable(false);
				textField_39.setEditable(false);
				btnUpdate.setEnabled(true);
				btnSaveUpdate.setEnabled(false);
			
				try{
					
					
					
					
					if(rs.previous()){
						repopulate();
					}else{
						rs.first();
						JOptionPane.showMessageDialog(null, "You have reached the first record");
					}
					
					
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp);
				}
			
			
			
			
			}
		});
		btnPrevious.setBounds(73, 403, 89, 23);
		panel_2.add(btnPrevious);
		
		btnNext = new JButton("Next");
		btnNext.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				textField_6.setEditable(false);
				textField_7.setEditable(false);
				textField_8.setEditable(false);
				textField_9.setEditable(false);
				textField_10.setEditable(false);
				textField_11.setEditable(false);
				textField_12.setEditable(false);
				textField_38.setEditable(false);
				textField_39.setEditable(false);
				btnUpdate.setEnabled(true);
				btnSaveUpdate.setEnabled(false);
				
				try{
				
					
					if(rs.next()){
						repopulate();
					}else{
						rs.last();
						JOptionPane.showMessageDialog(null, "You have reach the last record");
					}
					
					
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp + "error next");
				}
			
			
			}
		});
		btnNext.setBounds(172, 403, 89, 23);
		panel_2.add(btnNext);
		
		btnUpdate = new JButton("Update");
		btnUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				
				int confirm = JOptionPane.showConfirmDialog(null, "Are you sure to update this record?", "Update Confirm", JOptionPane.YES_NO_OPTION, JOptionPane.WARNING_MESSAGE);
			
				if(confirm == JOptionPane.YES_OPTION){
					
					
					textField_6.setEditable(true);
					textField_7.setEditable(true);
					textField_8.setEditable(true);
					textField_9.setEditable(true);
					textField_10.setEditable(true);
					textField_11.setEditable(true);
					textField_12.setEditable(true);
					textField_38.setEditable(true);
					textField_39.setEditable(true);
					btnUpdate.setEnabled(false);
					btnSaveUpdate.setEnabled(true);
					
					
				}
				
			
			}
		});
		btnUpdate.setBounds(283, 137, 115, 23);
		panel_2.add(btnUpdate);
		
		btnSaveUpdate = new JButton("Save Update");
		btnSaveUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				try{
					rs.updateString("emp_id", textField_13.getText());
					rs.updateString("firstname", textField_6.getText());
					rs.updateString("lastname", textField_7.getText());
					rs.updateString("position", textField_8.getText());
					rs.updateString("department", textField_9.getText());
					rs.updateString("date_hired", textField_10.getText());
					rs.updateString("status", textField_11.getText());
					rs.updateInt("monthly_salary", Integer.parseInt(textField_12.getText()));
					rs.updateInt("sick_leave", Integer.parseInt(textField_38.getText()));
					rs.updateInt("vacation_leave", Integer.parseInt(textField_39.getText()));
					rs.updateRow();
					dbconn.con.commit();
					
					JOptionPane.showMessageDialog(null, "Update Successful");
					
					textField_6.setEditable(false);
					textField_7.setEditable(false);
					textField_8.setEditable(false);
					textField_9.setEditable(false);
					textField_10.setEditable(false);
					textField_11.setEditable(false);
					textField_12.setEditable(false);
					textField_38.setEditable(false);
					textField_39.setEditable(false);
					btnUpdate.setEnabled(true);
					btnSaveUpdate.setEnabled(false);
					
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp);
				}
			
			
			}
		});
		btnSaveUpdate.setEnabled(false);
		btnSaveUpdate.setBounds(283, 166, 115, 23);
		panel_2.add(btnSaveUpdate);
		
		JLabel lblSickLeave_1 = new JLabel("SL:");
		lblSickLeave_1.setBounds(26, 336, 91, 26);
		panel_2.add(lblSickLeave_1);
		
		textField_38 = new JTextField();
		textField_38.setEditable(false);
		textField_38.setBounds(108, 337, 150, 20);
		panel_2.add(textField_38);
		textField_38.setColumns(10);
		
		JLabel lblVacationLeave_1 = new JLabel("VL:");
		lblVacationLeave_1.setBounds(26, 361, 91, 26);
		panel_2.add(lblVacationLeave_1);
		
		textField_39 = new JTextField();
		textField_39.setEditable(false);
		textField_39.setBounds(108, 364, 150, 20);
		panel_2.add(textField_39);
		textField_39.setColumns(10);
		
		panel_3 = new JPanel();
		frmJpayrollsystemV.getContentPane().add(panel_3, "name_1569123679117");
		panel_3.setLayout(null);
		panel_3.setVisible(false);
		
		JPanel panel_5 = new JPanel();
		panel_5.setBorder(new TitledBorder(UIManager.getBorder("TitledBorder.border"), "Employee Information", TitledBorder.LEADING, TitledBorder.TOP, null, new Color(0, 0, 0)));
		panel_5.setBounds(30, 24, 509, 161);
		panel_3.add(panel_5);
		panel_5.setLayout(null);
		
		JLabel lblDate = new JLabel("Date:");
		lblDate.setBounds(6, 26, 58, 20);
		panel_5.add(lblDate);
		
		JLabel lblEmployeeId_2 = new JLabel("Employee ID:");
		lblEmployeeId_2.setBounds(6, 52, 100, 30);
		panel_5.add(lblEmployeeId_2);
		
		textField_16 = new JTextField();
		textField_16.setBounds(82, 57, 63, 20);
		panel_5.add(textField_16);
		textField_16.setColumns(10);
		
		JButton btnSearch = new JButton("Search");
		btnSearch.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				try{
					
					String val = textField_16.getText();
					String searchsql = "SELECT * FROM employee_records WHERE emp_id=?";
					
					pst = dbconn.con.prepareStatement(searchsql);
					pst.setString(1, val);
					rs1 = pst.executeQuery();
					
					
						if(rs1.next()){
							
							String fname = rs1.getString("firstname");
							String lname = rs1.getString("lastname");
							
							textField_17.setText(fname + " " + lname);
							textField_18.setText(rs1.getString("department"));
							textField_19.setText(rs1.getString("position"));
							textField_20.setText(Integer.toString(rs1.getInt("monthly_salary")));
							
						}else{
							JOptionPane.showMessageDialog(null, "Error: Employee ID doesn't exist");
						}
					
					
						//SSS contribution
						
						int msalary = Integer.parseInt(textField_20.getText());
						double ssscont = 0;
						
						if(msalary>1000 && msalary<1250.99){
							ssscont = 0 + 36.30 / 2;
						}else if(msalary>1250 && msalary<1749.99){
							ssscont = 0 + 54.50 / 2 ;
						}else if(msalary>1750 && msalary<2249.99){
							ssscont = 0 + 72.70 / 2;
						}else if(msalary>2250 && msalary<2749.99){
							ssscont = 0 + 90.80 / 2;
						}else if(msalary>2750 && msalary<3249.99){
							ssscont = 0 + 109 / 2;
						}else if(msalary>3250 && msalary<3749.99){
							ssscont = 0 + 127.20 / 2;
						}else if(msalary>3750 && msalary<4249.99){
							ssscont = 0 + 145.30 / 2;
						}else if(msalary>4250 && msalary<4749.99){
							ssscont = 0 + 163.50 / 2;
						}else if(msalary>4750 && msalary<5249.99){
							ssscont = 0 + 181.70 / 2;
						}else if(msalary>5250 && msalary<5749.99){
							ssscont = 0 + 199.80 / 2;
						}else if (msalary>5750 && msalary<6249.99){
							ssscont = 0 + 218 / 2;
						}else if(msalary>6250 && msalary<6749.99){
							ssscont = 0 + 236.20 / 2;
						}else if(msalary>6750 && msalary<7249.99){
							ssscont = 0 + 254.30 / 2;
						}else if(msalary>7250 && msalary<7749.99){
							ssscont = 0 + 272.50 / 2;
						}else if(msalary>7750 && msalary<8249.99){
							ssscont = 0 + 290.70 / 2;
						}else if(msalary>8250 && msalary<8749.99){
							ssscont = 0 + 308.80 / 2;
						}else if(msalary>8750 && msalary<9249.99){
							ssscont = 0 + 327 / 2;
						}else if(msalary>9250 && msalary<9749.99){
							ssscont = 0 + 345.20 / 2;
						}else if(msalary>9750 && msalary<10249.99){
							ssscont = 0 + 363.30 / 2;
						}else if(msalary>10250 && msalary<10749.99){
							ssscont = 0 + 381.50 /2;
						}else if(msalary>10750 && msalary<11249.99){
							ssscont = 0 + 399.70 / 2;
						}else if(msalary>11250 && msalary<11749.99){
							ssscont = 0 + 417.80 / 2;
						}else if(msalary>11750 && msalary<12249.99){
							ssscont = 0 + 436 / 2;
						}else if(msalary>12250 && msalary<12749.99){
							ssscont = 0 + 454.20 / 2;
						}else if(msalary>12750 && msalary<13249.99){
							ssscont = 0 + 472.30 / 2;
						}else if(msalary>13250 && msalary<13749.99){
							ssscont = 0 + 490.50 / 2;
						}else if(msalary>13750 && msalary<14249.99){
							ssscont = 0 + 508.70 / 2;
						}else if(msalary>14250 && msalary<14749.99){
							ssscont = 0 + 526.80 / 2;
						}else if(msalary>14750 && msalary<15249.99){
							ssscont = 0 + 545 / 2;
						}else if(msalary>15250 && msalary<15749.99){
							ssscont = 0 + 563.20 / 2;
						}else if(msalary >= 15750){
							ssscont = 0 + 581.30 / 2;
						}
						
						String sss = Double.toString(ssscont);
						
						textField_23.setText(sss);
		
						//Phil . Health
						
						double phcont = 0;
						
						if(msalary <= 8999.99){
							phcont = 0 + 100.00 / 2;
						}else if(msalary>=9000 && msalary<=9999.99){
							phcont = 0 + 112.50 / 2 ;
						}else if(msalary>=10000 && msalary<=10999.99){
							phcont = 0 + 125.00 / 2;
						}else if(msalary>=11000 && msalary<=11999.99){
							phcont = 0 + 137.50 / 2;
						}else if(msalary>=12000 && msalary<=12999.99){
							phcont = 0 + 150.00 / 2;
						}else if(msalary>=13000 && msalary<=13999.99){
							phcont = 0 + 162.50 / 2;
						}else if(msalary>=14000 && msalary<=14999.99){
							phcont = 0 + 175.00 / 2;
						}else if(msalary>=15000 && msalary<=15999.99){
							phcont = 0 + 187.50 / 2;
						}else if(msalary>=16000 && msalary<=16999.99){
							phcont = 0 + 200.00 / 2;
						}else if(msalary>=17000 && msalary<=17999.99){
							phcont = 0 + 212.60 / 2;
						}else if (msalary>=18000 && msalary<=18999.99){
							phcont = 0 + 225.00 / 2;
						}else if(msalary>=19000 && msalary<=19999.99){
							phcont = 0 + 237.50 / 2;
						}else if(msalary>=20000 && msalary<=20999.99){
							phcont = 0 + 250.00 / 2;
						}else if(msalary>=21000 && msalary<=21999.99){
							phcont = 0 + 262.50 / 2;
						}else if(msalary>=22000 && msalary<=22999.99){
							phcont = 0 + 275.00 / 2;
						}else if(msalary>=23000 && msalary<=23999.99){
							phcont = 0 + 287.50 / 2;
						}else if(msalary>=24000 && msalary<=24999.99){
							phcont = 0 + 300.00 / 2;
						}else if(msalary>=25000 && msalary<=25999.99){
							phcont = 0 + 312.50 / 2;
						}else if(msalary>=26000 && msalary<=26999.99){
							phcont = 0 + 325.00 / 2;
						}else if(msalary>=27000 && msalary<=27999.99){
							phcont = 0 + 337.50 /2;
						}else if(msalary>=28000 && msalary<=28999.99){
							phcont = 0 + 350.00 / 2;
						}else if(msalary>=29000 && msalary<=29999.99){
							phcont = 0 + 362.50 / 2;
						}else if(msalary>=30000 && msalary<=30999.99){
							phcont = 0 + 375 / 2;
						}else if(msalary>=31000 && msalary<=31999.99){
							phcont = 0 + 387.50 / 2;
						}else if(msalary>=32000 && msalary<=32999.99){
							phcont = 0 + 400.00 / 2;
						}else if(msalary>=33000 && msalary<=33999.99){
							phcont = 0 + 412.50 / 2;
						}else if(msalary>=34000 && msalary<=34999.99){
							phcont = 0 + 425 / 2;
						}else if(msalary>=35000){
							phcont = 0 + 437.50 / 2;
						}
						
						String ph = Double.toString(phcont);
						
						textField_24.setText(ph);
					
				}catch(Exception exp){
					JOptionPane.showMessageDialog(null, exp);
				}
			
			
			}
		});
		btnSearch.setBounds(149, 56, 84, 23);
		panel_5.add(btnSearch);
		
		JLabel lblEmployeeName = new JLabel("Employee Name:");
		lblEmployeeName.setBounds(6, 88, 100, 30);
		panel_5.add(lblEmployeeName);
		
		textField_17 = new JTextField();
		textField_17.setEditable(false);
		textField_17.setBounds(111, 93, 136, 20);
		panel_5.add(textField_17);
		textField_17.setColumns(10);
		
		JLabel lblEmployeeDepartment = new JLabel("Employee Dept:");
		lblEmployeeDepartment.setBounds(6, 124, 100, 30);
		panel_5.add(lblEmployeeDepartment);
		
		textField_18 = new JTextField();
		textField_18.setEditable(false);
		textField_18.setBounds(111, 129, 136, 20);
		panel_5.add(textField_18);
		textField_18.setColumns(10);
		
		JLabel lblPosition_2 = new JLabel("Position:");
		lblPosition_2.setBounds(257, 93, 63, 20);
		panel_5.add(lblPosition_2);
		
		textField_19 = new JTextField();
		textField_19.setEditable(false);
		textField_19.setBounds(317, 93, 136, 20);
		panel_5.add(textField_19);
		textField_19.setColumns(10);
		
		JLabel lblStatus_2 = new JLabel("Salary:");
		lblStatus_2.setBounds(257, 124, 58, 30);
		panel_5.add(lblStatus_2);
		
		textField_20 = new JTextField();
		textField_20.setEditable(false);
		textField_20.setBounds(317, 129, 136, 20);
		panel_5.add(textField_20);
		textField_20.setColumns(10);
		
		dateChooser = new JDateChooser();
		dateChooser.setBounds(82, 26, 116, 20);
		panel_5.add(dateChooser);
		
		JLabel lblTo = new JLabel("TO");
		lblTo.setBounds(208, 29, 46, 14);
		panel_5.add(lblTo);
		
		dateChooser_1 = new JDateChooser();
		dateChooser_1.setBounds(236, 26, 116, 20);
		panel_5.add(dateChooser_1);
		
		JPanel panel_6 = new JPanel();
		panel_6.setBorder(new TitledBorder(UIManager.getBorder("TitledBorder.border"), "Deductions", TitledBorder.CENTER, TitledBorder.TOP, null, new Color(0, 0, 0)));
		panel_6.setBounds(314, 193, 427, 259);
		panel_3.add(panel_6);
		panel_6.setLayout(null);
		
		JLabel lblSssContribution = new JLabel("SSS Contribution:");
		lblSssContribution.setBounds(6, 16, 100, 30);
		panel_6.add(lblSssContribution);
		
		textField_23 = new JTextField();
		textField_23.setText("0");
		textField_23.setBounds(116, 21, 86, 20);
		panel_6.add(textField_23);
		textField_23.setColumns(10);
		
		JLabel lblPagibigContribution = new JLabel("Pag-Ibig Cont:");
		lblPagibigContribution.setBounds(6, 52, 100, 30);
		panel_6.add(lblPagibigContribution);
		
		textField_21 = new JTextField();
		textField_21.setText("0");
		textField_21.setBounds(116, 57, 86, 20);
		panel_6.add(textField_21);
		textField_21.setColumns(10);
		
		JLabel lblWholdingTax = new JLabel("W/Holding Tax:");
		lblWholdingTax.setBounds(6, 88, 100, 30);
		panel_6.add(lblWholdingTax);
		
		textField_22 = new JTextField();
		textField_22.setText("0");
		textField_22.setBounds(116, 93, 86, 20);
		panel_6.add(textField_22);
		textField_22.setColumns(10);
		
		JLabel lblPhilHealth = new JLabel("Phil. Health:");
		lblPhilHealth.setBounds(6, 124, 100, 30);
		panel_6.add(lblPhilHealth);
		
		textField_24 = new JTextField();
		textField_24.setText("0");
		textField_24.setBounds(116, 129, 86, 20);
		panel_6.add(textField_24);
		textField_24.setColumns(10);
		
		JButton btnSssLoan = new JButton("SSS Loan");
		btnSssLoan.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				textField_25.setVisible(true);
			
			
			}
		});
		btnSssLoan.setBounds(221, 20, 100, 23);
		panel_6.add(btnSssLoan);
		
		textField_25 = new JTextField();
		textField_25.setText("0");
		textField_25.setBounds(331, 21, 86, 20);
		panel_6.add(textField_25);
		textField_25.setColumns(10);
		textField_25.setVisible(false);
		
		
		JButton btnNewButton = new JButton("HDMF Loan");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
			
				textField_26.setVisible(true);
			
			
			}
		});
		btnNewButton.setBounds(221, 56, 100, 23);
		panel_6.add(btnNewButton);
		
		textField_26 = new JTextField();
		textField_26.setText("0");
		textField_26.setBounds(331, 57, 86, 20);
		panel_6.add(textField_26);
		textField_26.setColumns(10);
		textField_26.setVisible(false);
		
		JComboBox comboBox_4 = new JComboBox();
		comboBox_4.setBounds(6, 165, 100, 20);
		panel_6.add(comboBox_4);
		comboBox_4.setModel(new DefaultComboBoxModel(new String[] {"Other loan", "Salary Loan", "Emergency Loan"}));
		
		textField_27 = new JTextField();
		textField_27.setText("0");
		textField_27.setBounds(116, 165, 86, 20);
		panel_6.add(textField_27);
		textField_27.setColumns(10);
		
		JLabel lblTotalDeduction = new JLabel("Total Deduction:");
		lblTotalDeduction.setBounds(6, 207, 100, 24);
		panel_6.add(lblTotalDeduction);
		
		textField_28 = new JTextField();
		textField_28.setEditable(true);
		textField_28.setBounds(116, 209, 86, 20);
		panel_6.add(textField_28);
		textField_28.setColumns(10);
		
		JButton btnCompute = new JButton("Compute");
		btnCompute.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			
			
				double social = Double.parseDouble(textField_23.getText());
				double hdmf = Double.parseDouble(textField_21.getText());
				double tax = Double.parseDouble(textField_22.getText());
				double phcont = Double.parseDouble(textField_24.getText());
				double sssloan = Double.parseDouble(textField_25.getText());
				double hdmfloan = Double.parseDouble(textField_26.getText());
				double otherloan = Double.parseDouble(textField_27.getText());
				
				double totalDeduction = social + hdmf + tax + phcont + sssloan + hdmfloan + otherloan;
				
				textField_28.setText(Double.toString(totalDeduction));
				
			}
		});
		btnCompute.setBounds(212, 208, 89, 23);
		panel_6.add(btnCompute);
		
		JLabel lblNoOfAbsences = new JLabel("No. of Absences");
		lblNoOfAbsences.setBounds(221, 92, 100, 22);
		panel_6.add(lblNoOfAbsences);
		
		textField_34 = new JTextField();
		textField_34.setText("0");
		textField_34.setBounds(331, 93, 86, 20);
		panel_6.add(textField_34);
		textField_34.setColumns(10);
		
		JPanel panel_7 = new JPanel();
		panel_7.setBorder(new TitledBorder(UIManager.getBorder("TitledBorder.border"), "Gross", TitledBorder.CENTER, TitledBorder.TOP, null, new Color(0, 0, 0)));
		panel_7.setBounds(24, 193, 214, 193);
		panel_3.add(panel_7);
		panel_7.setLayout(null);
		
		JLabel lblBasicSalary = new JLabel("Basic Salary:");
		lblBasicSalary.setBounds(6, 16, 86, 27);
		panel_7.add(lblBasicSalary);
		
		textField_29 = new JTextField();
		textField_29.setBounds(90, 19, 86, 20);
		panel_7.add(textField_29);
		textField_29.setColumns(10);
		
		JLabel lblCola = new JLabel("C.O.L.A :");
		lblCola.setBounds(6, 54, 61, 14);
		panel_7.add(lblCola);
		
		textField_30 = new JTextField();
		textField_30.setBounds(90, 51, 86, 20);
		panel_7.add(textField_30);
		textField_30.setColumns(10);
		
		JLabel lblBenefits = new JLabel("Benefits:");
		lblBenefits.setBounds(6, 85, 74, 14);
		panel_7.add(lblBenefits);
		
		textField_31 = new JTextField();
		textField_31.setBounds(90, 82, 86, 20);
		panel_7.add(textField_31);
		textField_31.setColumns(10);
		
		JLabel lblGrossPay = new JLabel("Gross Pay:");
		lblGrossPay.setBounds(6, 120, 61, 14);
		panel_7.add(lblGrossPay);
		
		textField_32 = new JTextField();
		textField_32.setEditable(false);
		textField_32.setBounds(90, 117, 86, 20);
		panel_7.add(textField_32);
		textField_32.setColumns(10);
		
		JButton btnNewButton_1 = new JButton("Compute");
		btnNewButton_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				double bs = Double.parseDouble(textField_29.getText());
				double cola = Double.parseDouble(textField_30.getText());
				double benefits = Double.parseDouble(textField_31.getText());
				
				double gp = bs + cola + benefits;
				
				textField_32.setText(Double.toString(gp));
				
			}
		});
		btnNewButton_1.setBounds(76, 148, 100, 20);
		panel_7.add(btnNewButton_1);
		
		JLabel lblPhp = new JLabel("Php:");
		lblPhp.setBounds(41, 397, 46, 14);
		panel_3.add(lblPhp);
		
		textField_33 = new JTextField();
		textField_33.setEditable(false);
		textField_33.setBounds(78, 394, 86, 20);
		panel_3.add(textField_33);
		textField_33.setColumns(10);
		
		JButton btnComputeNetpay = new JButton("Compute Netpay");
		btnComputeNetpay.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			
			
			double netpay = Double.parseDouble(textField_32.getText()) - Double.parseDouble(textField_28.getText());
			
			textField_33.setText(Double.toString(netpay));
			
			}
		});
		btnComputeNetpay.setBounds(54, 425, 131, 27);
		panel_3.add(btnComputeNetpay);
		
		JButton btnClearAll = new JButton("CLEAR ALL");
		btnClearAll.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				textField_16.setText("");
				textField_17.setText("");
				textField_18.setText("");
				textField_19.setText("");
				textField_20.setText("");
				textField_23.setText("0");
				
				textField_29.setText("0");
				textField_30.setText("0");
				textField_31.setText("0");
				textField_32.setText("0");
				textField_21.setText("0");
				textField_22.setText("0");
				textField_24.setText("0");
				textField_27.setText("0");
				textField_34.setText("0");
				textField_33.setText("0");
				textField_28.setText("0");
				
			}
		});
		btnClearAll.setBounds(572, 99, 106, 23);
		panel_3.add(btnClearAll);
		
		JButton btnExportPayroll = new JButton("Export");
		btnExportPayroll.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
			
				String date = ((JTextField) dateChooser.getDateEditor().getUiComponent()).getText(); 
				String date1 = ((JTextField) dateChooser_1.getDateEditor().getUiComponent()).getText();

				String filename = textField_17.getText() + "(" + date1 + ")" + "_payslip";	
				
				File newfile = new File("C:\\Users\\Raineir\\Desktop\\javaforever\\" + filename);
				
				
				try{
					
					FileWriter fw;
					BufferedWriter bw;
					
					fw = new FileWriter("C:\\Users\\Raineir\\Desktop\\javaforever\\" + filename + ".txt");
					bw = new BufferedWriter(fw);
					bw.append(textField_17.getText());
					bw.append("\r\n");
					bw.append("Payroll period: " + date + " to " + date1);
					bw.append("\r\n\r\n");
					bw.append("\r\n\r\n");
					
					bw.append("Gross Earnings");
					bw.append("\r\n\r\n");
					
					bw.append("Basic: ");
					bw.append(textField_29.getText());
					bw.append("\r\n");
					bw.append("C.O.L.A: ");
					bw.append(textField_30.getText());
					bw.append("\r\n");
					bw.append("Employee Benefits: ");
					bw.append(textField_31.getText());
					bw.append("\r\n\r\n");
					bw.append("Total Gross: ");
					bw.append(textField_32.getText());
					
					bw.append("\r\n\r\n");
					bw.append("Deductions");
					bw.append("\r\n\r\n");
					
					bw.append("SSS: ");
					bw.append(textField_23.getText());
					bw.append("\r\n");
					bw.append("Pag-Ibig: ");
					bw.append(textField_21.getText());
					bw.append("\r\n");
					bw.append("WithHolding Tax: ");
					bw.append(textField_22.getText());
					bw.append("\r\n");
					bw.append("Phil. Health: ");
					bw.append(textField_24.getText());
					bw.append("\r\n");
					bw.append("SSS Loan: ");
					bw.append(textField_25.getText());
					bw.append("\r\n");
					bw.append("Pag-Ibig Loan: ");
					bw.append(textField_26.getText());
					bw.append("\r\n");
					bw.append("Other Deductions: ");
					bw.append(textField_27.getText());
					bw.append("\r\n\r\n");
					bw.append("Total Deductions: ");
					bw.append(textField_28.getText());
					bw.append("\r\n\r\n");
					
					bw.append("Netpay: ");
					bw.append(textField_33.getText());
					bw.append("\r\n");
					bw.append("       ==========");
					
					
					bw.close();
					fw.close();
					
					JOptionPane.showMessageDialog(null, "File export created!");
					
					
				}catch(Exception exp){
					
				}
				
			}
		});
		btnExportPayroll.setBounds(572, 133, 106, 23);
		panel_3.add(btnExportPayroll);
		
		panel_8 = new JPanel();
		panel_8.setVisible(false);
		frmJpayrollsystemV.getContentPane().add(panel_8, "name_12939968770200");
		panel_8.setLayout(null);
		
		JLabel lblThankYouFor = new JLabel("Thank you for using this payroll system!");
		lblThankYouFor.setBounds(257, 183, 267, 14);
		panel_8.add(lblThankYouFor);
		
		JLabel lblThisAppIs = new JLabel("This app is created by Raineir John C. Serinas");
		lblThisAppIs.setBounds(459, 440, 267, 14);
		panel_8.add(lblThisAppIs);
		
		JMenuBar menuBar = new JMenuBar();
		frmJpayrollsystemV.setJMenuBar(menuBar);
		
		JMenu mnFile = new JMenu("Authentication");
		menuBar.add(mnFile);
		
		mntmLogIn = new JMenuItem("Log In");
		mntmLogIn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				
			mntmLogout.setEnabled(true);
			mntmLogIn.setEnabled(false);
			internalFrame.setVisible(true);			
			
			}
		});
		mnFile.add(mntmLogIn);
		
		mntmLogout = new JMenuItem("Logout");
		mntmLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
			panel_1.setVisible(false);
			panel_2.setVisible(false);
			panel_3.setVisible(false);
			panel.setVisible(true);
			mntmLogout.setEnabled(false);
			mntmLogIn.setEnabled(true);
			
			
			}
		});
		mnFile.add(mntmLogout);
		mntmLogout.setEnabled(false);
		
		mnRecords = new JMenu("Records");
		menuBar.add(mnRecords);
		mnRecords.setEnabled(false);
		
		JMenuItem mntmAddRecord = new JMenuItem("Add Record");
		mntmAddRecord.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				panel.setVisible(false);
				panel_1.setVisible(true);
				panel_2.setVisible(false);
				panel_3.setVisible(false);
				panel_8.setVisible(false);
			}
		});
		mnRecords.add(mntmAddRecord);
		
		JMenuItem mntmViewRecord = new JMenuItem("View/Edit Record");
		mntmViewRecord.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				
				panel.setVisible(false);
				panel_1.setVisible(false);
				panel_2.setVisible(true);
				panel_3.setVisible(false);
				panel_8.setVisible(false);
			
			
			}
		});
		mnRecords.add(mntmViewRecord);
		
		mnPayroll = new JMenu("Payroll");
		menuBar.add(mnPayroll);
		mnPayroll.setEnabled(false);
		
		JMenuItem mntmGeneratePayroll = new JMenuItem("Generate Payroll");
		mntmGeneratePayroll.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				panel.setVisible(false);
				panel_1.setVisible(false);
				panel_2.setVisible(false);
				panel_3.setVisible(true);
				panel_8.setVisible(false);
			
			
			}
		});
		mnPayroll.add(mntmGeneratePayroll);
		
		JMenuItem mntmViewPayroll = new JMenuItem("View Payroll");
		mntmViewPayroll.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				panel.setVisible(false);
				panel_1.setVisible(false);
				panel_2.setVisible(false);
				panel_3.setVisible(false);
				panel_8.setVisible(false);
			
			}
		});
		mnPayroll.add(mntmViewPayroll);
		
		mnAbout = new JMenu("About");
		mnAbout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				panel.setVisible(false);
				panel_1.setVisible(false);
				panel_2.setVisible(false);
				panel_3.setVisible(false);
				panel_8.setVisible(true);
			
			
			
			}
		});
		menuBar.add(mnAbout);
		mnAbout.setEnabled(false);
		
		JMenuItem mntmNewMenuItem = new JMenuItem("About JPayroll System");
		mntmNewMenuItem.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			
				panel.setVisible(false);
				panel_1.setVisible(false);
				panel_2.setVisible(false);
				panel_3.setVisible(false);
				panel_8.setVisible(true);
			
			}
		});
		mnAbout.add(mntmNewMenuItem);
	}

	public void repopulate(){
		
		try{
			
			
			
			
			textField_13.setText(rs.getString("emp_id"));
			textField_6.setText(rs.getString("firstname"));
			textField_7.setText(rs.getString("lastname"));
			textField_8.setText(rs.getString("position"));
			textField_9.setText(rs.getString("department"));
			textField_10.setText(rs.getString("date_hired"));
			textField_11.setText(rs.getString("status"));
			textField_12.setText(Integer.toString(rs.getInt("monthly_salary")));
			textField_38.setText(Integer.toString(rs.getInt("sick_leave")));
			textField_39.setText(Integer.toString(rs.getInt("vacation_leave")));
			
			
		}catch(Exception exp){
			JOptionPane.showMessageDialog(null, exp);
		}
		
		
		
	}


	public void  putdata(){
		
		
		try{
		st = dbconn.con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
		String sql = "SELECT * FROM employee_records";
		rs = st.executeQuery(sql);
		
		rs.next();
		textField_13.setText(rs.getString("emp_id"));
		textField_6.setText(rs.getString("firstname"));
		textField_7.setText(rs.getString("lastname"));
		textField_8.setText(rs.getString("position"));
		textField_9.setText(rs.getString("department"));
		textField_10.setText(rs.getString("date_hired"));
		textField_11.setText(rs.getString("status"));
		textField_12.setText(Integer.toString(rs.getInt("monthly_salary")));
		textField_38.setText(Integer.toString(rs.getInt("sick_leave")));
		textField_39.setText(Integer.toString(rs.getInt("vacation_leave")));
		}catch(Exception exp){
			JOptionPane.showMessageDialog(null, "No records yet");
		}
	}
}
