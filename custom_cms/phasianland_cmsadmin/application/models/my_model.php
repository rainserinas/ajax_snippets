<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class My_Model extends CI_Model {
        private $table;
        private $fields = array();
        private $select = array();

        function __construct(){
          parent::__construct();
        }

        function set_up_table($table, $fields = null, $select = null) {
            $this->table = $table;
            $this->select = $select;

            if(!empty($fields)) {
                foreach($fields as $key) {
                    $this->fields[$key] = null;
                }
            }
        }

        function __call($method, $args) {
            if(preg_match("/set_(.*)/", $method, $exists)) {
                if(array_key_exists($exists[1], $this->fields)) {
                    $this->fields[$exists[1]] = $args[0];
                    return true;
                }
            }
            return false;
        }

        function select($where = null, $join = null, $order = null, $limit = null) {
            if(!empty($join)) {
                foreach($this->select as $key) {
                    $this->select[$key] = $this->table.'.'.$key;
                    $select[] = $this->select[$key];
                }

                foreach($join as $get_join) {

                    foreach($get_join['fields'] as $fields) {
                        $get_join['fields'][$fields] = $get_join['table'].'.'.$fields;
                        $join_fields[] = $get_join['fields'][$fields];
                    }


                    if(!empty($where)) {
                        foreach($where as $key=>$value) {
                            $where = array($this->table.'.'.$key=>$value);
                        }
                    }

                    $tbl_id = $this->table.'.'.$get_join['id'];
                    $ref_id = $get_join['table'].'.'.$get_join['join_id'];

                    $this->db->join($get_join['table'], $tbl_id .'='. $ref_id, $get_join['type']);
                }
                
            } else {
                $select = $this->select;
                $where = $where;
                $join_fields = array();
            }

            $this->db->select(array_merge($select, $join_fields));
            $this->db->from($this->table);

            $where = (empty($where) ? '' : $this->db->where($where));
            $limit = (empty($limit) ? '' : $this->db->limit($limit));
            $order = (empty($order) ? '' : $this->db->order_by($order['order_by'], $order['order']));

            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $results[] = $row;
                }

                return $results;
            } else {
                return false;
            }
        }

        function insert() {
            $this->db->insert($this->table, $this->fields);
            return $this->db->insert_id();
        }

        function update($id) {
            $key = array_keys($id);

            $this->db->where($key[0], $id[$key[0]]);
            $this->db->update($this->table, $this->fields);
            return true;
        }

        function remove($id) {
            $this->db->delete($this->table, $id);
            return true;
        }

    }