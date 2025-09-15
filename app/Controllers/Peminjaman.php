<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PegawaiModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Peminjaman extends Controller
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        $items = $this->peminjamanModel->findAll();

        foreach ($items as &$item) {
            if ($item['status'] == 'Dipinjam') {
                $today = date('Y-m-d');
                if ($today > $item['rencana_kembali']) {
                    $item['status'] = 'Terlambat';
                    $this->peminjamanModel->update($item['id'], ['status' => 'Terlambat']);
                }
            }
        }

        return view('peminjaman/index', ['items' => $items]);
    }

    public function create()
    {
        $pegawaiModel = new PegawaiModel();
        $pegawaiList = $pegawaiModel->findAll();

        return view('peminjaman/form', ['pegawaiList' => $pegawaiList]);
    }

    public function store()
    {
        $this->peminjamanModel->insert([
            'nama_peminjam'   => $this->request->getPost('nama_peminjam'),
            'merk_laptop'     => $this->request->getPost('merk_laptop'),
            'tgl_pinjam'      => $this->convertDate($this->request->getPost('tgl_pinjam')),
            'rencana_kembali' => $this->convertDate($this->request->getPost('rencana_kembali')),
            'petugas_pinjam'  => $this->request->getPost('petugas_pinjam'),
            'petugas_kembali' => $this->request->getPost('petugas_kembali'),
            'keperluan'       => $this->request->getPost('keperluan'),
            'tgl_kembali'     => $this->convertDate($this->request->getPost('tgl_kembali')),
            'status'          => 'Dipinjam'
        ]);

        return redirect()->to(site_url('peminjaman'))->with('message', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data peminjaman dengan ID $id tidak ditemukan.");
        }

        return view('peminjaman/show', ['peminjaman' => $peminjaman]);
    }

    public function edit($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data peminjaman dengan ID $id tidak ditemukan");
        }

        $pegawaiModel = new PegawaiModel();
        $pegawaiList = $pegawaiModel->findAll();

        return view('peminjaman/form', [
            'item' => $peminjaman,
            'pegawaiList' => $pegawaiList
        ]);
    }

    public function update($id)
    {
        $this->peminjamanModel->update($id, [
            'nama_peminjam'   => $this->request->getPost('nama_peminjam'),
            'merk_laptop'     => $this->request->getPost('merk_laptop'),
            'tgl_pinjam'      => $this->convertDate($this->request->getPost('tgl_pinjam')),
            'rencana_kembali' => $this->convertDate($this->request->getPost('rencana_kembali')),
            'petugas_pinjam'  => $this->request->getPost('petugas_pinjam'),
            'petugas_kembali' => $this->request->getPost('petugas_kembali'),
            'keperluan'       => $this->request->getPost('keperluan'),
            'tgl_kembali'     => $this->convertDate($this->request->getPost('tgl_kembali')),
            'status'          => $this->request->getPost('status'),
        ]);

        return redirect()->to(site_url('peminjaman'))->with('message', 'Data berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        return redirect()->to(site_url('peminjaman'))->with('message', 'Data berhasil dihapus!');
    }

    public function kembalikan($id)
    {
        $row = $this->peminjamanModel->find($id);
        if (!$row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data dengan ID $id tidak ditemukan");
        }

        if (in_array($row['status'], ['Dipinjam', 'Terlambat'])) {
            $this->peminjamanModel->update($id, [
                'status'      => 'Dikembalikan',
                'tgl_kembali' => date('Y-m-d'),
            ]);
            session()->setFlashdata('message', 'Status berhasil diubah menjadi Dikembalikan.');
        } else {
            session()->setFlashdata('message', 'Data sudah berstatus Dikembalikan.');
        }

        return redirect()->to(site_url('peminjaman'));
    }

    private function convertDate($date)
    {
        if (!$date) return null;
        $parts = explode('/', $date);
        if (count($parts) == 3) {
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0]; // Y-m-d
        }
        return $date;
    }

    public function riwayat()
    {
        $data['riwayat'] = $this->peminjamanModel
            ->orderBy('tgl_pinjam', 'DESC')
            ->findAll();

        return view('riwayat/index', $data);
    }

    public function exportExcel()
    {
        $peminjaman = $this->peminjamanModel->orderBy('tgl_pinjam', 'DESC')->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Riwayat Peminjaman');

        $headers = ['ID', 'Nama Peminjam', 'Merk Laptop', 'Tanggal Pinjam', 'Tanggal Kembali', 'Petugas Pinjam', 'Petugas Kembali', 'Keperluan', 'Status'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $sheet->getStyle($col . '1')->getFont()->setBold(true);
            $col++;
        }

        $rowNumber = 2;
        foreach ($peminjaman as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row['id']);
            $sheet->setCellValue('B' . $rowNumber, $row['nama_peminjam']);
            $sheet->setCellValue('C' . $rowNumber, $row['merk_laptop']);
            $sheet->setCellValue('D' . $rowNumber, !empty($row['tgl_pinjam']) ? date('d/m/Y', strtotime($row['tgl_pinjam'])) : '');
            $sheet->setCellValue('E' . $rowNumber, !empty($row['tgl_kembali']) ? date('d/m/Y', strtotime($row['tgl_kembali'])) : '');
            $sheet->setCellValue('F' . $rowNumber, $row['petugas_pinjam']);
            $sheet->setCellValue('G' . $rowNumber, $row['petugas_kembali']);
            $sheet->setCellValue('H' . $rowNumber, $row['keperluan']);
            $sheet->setCellValue('I' . $rowNumber, $row['status']);
            $rowNumber++;
        }

        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'riwayat_peminjaman.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $items = $this->peminjamanModel
                ->like('nama_peminjam', $keyword)
                ->orLike('merk_laptop', $keyword)
                ->findAll();
        } else {
            $items = $this->peminjamanModel->findAll();
        }

        return view('peminjaman/index', [
            'items' => $items,
            'keyword' => $keyword
        ]);
    }

    public function cetak($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        $path = FCPATH . 'img/logo.png';
        $logo = 'data:image/png;base64,' . base64_encode(file_get_contents($path));

        $data = [
            'peminjaman' => $peminjaman,
            'logo'       => $logo
        ];

        $html = view('peminjaman/show_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Detail_Peminjaman.pdf", ["Attachment" => false]);
    }
}
