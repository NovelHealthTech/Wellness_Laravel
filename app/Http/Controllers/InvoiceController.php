<?php
namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
        public function generate(Request $request)
        {

            if (!session()->pull('invoice_once')) {
                return redirect()->route('home');
            }

            $bookingId = $request->booking_id;

            if (!$bookingId) {
                return redirect()->route('home');
            }
            $lastInvoice = Invoice::latest()->first();

            if ($lastInvoice) {
                preg_match('/(\d+)$/', $lastInvoice->invoice_no, $matches);
                $lastNumber = intval($matches[1] ?? 0);
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $currentMonth = now()->month;
            $currentYear = now()->year;

            if ($currentMonth >= 4) {
                $financialYear = substr($currentYear, 2, 2) . '-' . substr($currentYear + 1, 2, 2);
            } else {
                $financialYear = substr($currentYear - 1, 2, 2) . '-' . substr($currentYear, 2, 2);
            }

            $invoiceNo = "NHT/BOS/OD/{$financialYear}/{$formattedNumber}";

            $data = [
                'invoice_no' => $invoiceNo,
                'invoice_date' => now()->format('d F Y'),
                'patient_name' => 'Mr. Rajesh Kumar',
                'patient_address' => 'H-123, Sector 45, Gurugram',
                'patient_city' => 'Haryana, India',
                'patient_pincode' => '122003',
                'state_code' => '06',
                'payment_id' => 'PAY' . now()->format('Ymd') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT),
                'payment_method' => 'Online Transfer',
                'transaction_date' => now()->format('d M Y'),
                'service_name' => 'Complete Health Checkup Package',
                'service_description' => 'Includes: Blood Test, ECG, X-Ray, Doctor Consultation',
                'rate' => 3500.00,
                'quantity' => 1,
                'amount' => 3500.00,
                'subtotal' => 3500.00,
                'tax' => 0.00,
                'discount' => 0.00,
                'grand_total' => 3500.00,
                'amount_words' => 'Indian Rupees Three Thousand Five Hundred Only'
            ];

            // ✅ Simplified PDF configuration - NO custom fonts
            $pdf = Pdf::loadView('retailer.invoice', $data);

            $pdf->setPaper('a4', 'portrait');

            $fileName = "invoice_{$formattedNumber}.pdf";
            $path = "invoices/{$fileName}";

            Storage::disk('public')->put($path, $pdf->output());

            Invoice::create([
                'invoice_no' => $invoiceNo,
                'pdf_path' => $path,
            ]);

            return $pdf->stream($fileName);
        }
}