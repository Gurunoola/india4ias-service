<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConfigurationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'config_name' => 'required|string|unique:configurations',
            'config_data' => 'required|array',
        ]);

        $configuration = Configuration::create([
            'config_name' => $request->input('config_name'),
            'config_data' => $request->input('config_data'),
        ]);

        return response()->json(['message' => 'Configuration saved successfully', 'data' => $configuration], Response::HTTP_CREATED);
    }

    public function show($configName)
    {
        $configuration = Configuration::where('config_name', $configName)->firstOrFail();
        return response()->json(['data' => $configuration], Response::HTTP_OK);
    }

    public function update(Request $request, $configName)
    {
        $request->validate([
            'config_data' => 'required|array',
        ]);

        $configuration = Configuration::where('config_name', $configName)->firstOrFail();
        $configuration->update([
            'config_data' => $request->input('config_data'),
        ]);

        return response()->json(['message' => 'Configuration updated successfully', 'data' => $configuration], Response::HTTP_OK);
    }

    public function getAll()
    {
        $configurations = Configuration::all();
        return response()->json(['data' => $configurations], Response::HTTP_OK);
    }
}