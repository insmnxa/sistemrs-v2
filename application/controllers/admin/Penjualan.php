<?php

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['resep_model', 'penjualan_model']);
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $receipts = $this->resep_model->get_receipt();
        $data = ['receipts' => $receipts];

        $this->slice->view('pages/admin/penjualan/index', $data);
    }

    public function create(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $receipt = $this->resep_model->get_receipt_by_patient_id($id);
        $data = ['receipt' => json_decode($receipt)];

        $this->slice->view('pages/admin/penjualan/create', $data);
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $id_resep = $this->input->post('id_resep');
        $dibayar = $this->input->post('dibayar');
        $kembali = $this->input->post('kembali');

        $this->penjualan_model->store($dibayar, $kembali, $id_resep);
        redirect(base_url('admin/sellings'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }
    }

    public function fetch(string $date)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $sellings = $this->penjualan_model->filter_sellings_by_date($date);
        $total_transactions = $this->penjualan_model->get_transactions_by_date($date);

        $obj = new stdClass();
        $obj->sellings = $sellings;
        $obj->total_transactions = $total_transactions;

        echo json_encode($obj);
    }
}
