<?php

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('penjualan_model');

        $this->auth_model->get_current_user();

        $this->load->library('pdf');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $sellings = $this->penjualan_model->get_penjualan();
        $data = ['sellings' => $sellings];

        $this->slice->view('pages/admin/laporan/penjualan', $data);
    }

    public function print(string $date)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $sellings = $this->penjualan_model->filter_sellings_by_date($date);
        $total_transactions = $this->penjualan_model->get_transactions_by_date($date);

        $data = [
            'sellings' => $sellings,
            'total_transactions' => $total_transactions->total_harga,
            'transaction_date' => $date,
        ];

        $date_array = explode('-', $date);

        $data['title'] = implode('', $date_array).'_penjualan';
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = 'landscape';
        $html = $this->load->view('report_print', ['data' => $data], true);

        $this->pdf->generate($html, $file_pdf, $paper, $orientation);
    }

    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }
    }
}
