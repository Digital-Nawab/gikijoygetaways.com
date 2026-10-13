@extends('admin.layout.master')
@section('content') 
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800"> Welcome Admin 👋 </h2>
        <p class="text-slate-500 mt-2"> Here is your dashboard overview </p>
    </div>
    <div class="bg-white px-5 py-4 rounded-3xl shadow-lg">
        <p class="text-slate-500 text-sm">Logged in as</p>
        <h3 class="font-bold text-slate-800 text-lg"> {{ Auth::user()->email }} </h3>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm">Total Users</p>
                <h2 class="text-4xl font-bold text-slate-800 mt-2">1,245</h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl"> 👥 </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm">Bookings</p>
                <h2 class="text-4xl font-bold text-slate-800 mt-2">320</h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl"> 📦 </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm">Revenue</p>
                <h2 class="text-4xl font-bold text-slate-800 mt-2">₹85,000</h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl"> 💰 </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm">Pending Requests</p>
                <h2 class="text-4xl font-bold text-slate-800 mt-2">18</h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-2xl"> ⏳ </div>
        </div>
    </div>
</div> 
<div class="bg-white rounded-3xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-slate-800"> Recent Bookings </h3> <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition"> View All </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-4 px-4 text-slate-500 font-semibold">User</th>
                    <th class="py-4 px-4 text-slate-500 font-semibold">Destination</th>
                    <th class="py-4 px-4 text-slate-500 font-semibold">Date</th>
                    <th class="py-4 px-4 text-slate-500 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-4">Rahul Sharma</td>
                    <td class="py-4 px-4">Goa</td>
                    <td class="py-4 px-4">12 Apr 2026</td>
                    <td class="py-4 px-4"> <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium"> Confirmed </span> </td>
                </tr>
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-4">Priya Verma</td>
                    <td class="py-4 px-4">Manali</td>
                    <td class="py-4 px-4">15 Apr 2026</td>
                    <td class="py-4 px-4"> <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm font-medium"> Pending </span> </td>
                </tr>
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-4">Aman Singh</td>
                    <td class="py-4 px-4">Dubai</td>
                    <td class="py-4 px-4">18 Apr 2026</td>
                    <td class="py-4 px-4"> <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-medium"> Cancelled </span> </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
 @endsection