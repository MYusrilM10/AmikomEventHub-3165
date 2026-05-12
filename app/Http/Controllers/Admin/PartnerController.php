<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        Partner::create([
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ]);

        return redirect('/admin/partners')
        ->with('success', 'Partner berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);

        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $partner->update([
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ]);

        return redirect('/admin/partners')
        ->with('success', 'Partner berhasil diupdate!');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        $partner->delete();

        return redirect('/admin/partners')
        ->with('success', 'Partner berhasil dihapus!');
    }
}