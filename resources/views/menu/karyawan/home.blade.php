@extends('layouts.master')
@section('main')
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
            <!-- <a
            href="#"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            ><i class="fas fa-download fa-sm text-white-50"></i> Generate
            Report</a -->
            >
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                                >
                                    Hadir
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    18
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Daftar Karyawan
                        </h6>
                        <div class="dropdown no-arrow">
                            <button
                                @click="post('karyawan')"
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#exampleModal"
                            >
                                Tambah Karyawan
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">posisi</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(k, keys) in karyawan"
                                        :key="keys"
                                    >
                                        <td>{{ keys + 1 }}</td>
                                        <td>{{ k.nama }}</td>
                                        <td>{{ k.posisi.nama }}</td>
                                        <td>
                                            <a @click="deleteKaryawan(k)"
                                                ><i class="fas fa-trash"></i
                                            ></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Posisi
                        </h6>
                    </div>
                    <div class="card-body">
                        <form
                            class="input-group mb-3"
                            @submit.prevent="post('posisi')"
                        >
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Posisi"
                                aria-label="Posisi"
                                aria-describedby="basic-addon2"
                                v-model="pekerjaan"
                            />
                            <div class="input-group-append">
                                <button
                                    @click="submit('posisi')"
                                    class="btn btn-sm btn-success"
                                >
                                    Tambah
                                </button>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(p, key) in posisi" :key="key">
                                    <td>
                                        {{ p.nama }}
                                    </td>
                                    <a @click="deletePosisi(p)"
                                        ><i class="fas fa-trash"></i
                                    ></a>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <form
                    @submit.prevent="submit('karyawan')"
                    class="modal-content"
                    action="/karyawan/store"
                    method="POST"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Tambah Data
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                placeholder="Masukan Nama"
                                v-model="nama"
                            />
                        </div>
                        <div class="form-group">
                            <label for="nama">Jenis Kelamin</label>
                            <select
                                class="form-control"
                                id="nama"
                                name="jk"
                                v-model="jk"
                            >
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="posisi">Posisi</label>
                            <select
                                class="form-control"
                                id="posisi"
                                v-model="pekerjaan"
                            >
                                <option
                                    v-bind:value="p.id"
                                    v-for="(p, key) in posisi"
                                    :key="key"
                                >
                                    {{ p.nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea
                                type="text"
                                class="form-control"
                                id="alamat"
                                name="alamat"
                                v-model="alamat"
                            >
Masukan Alamat </textarea
                            >
                        </div>
                        <div class="form-group">
                            <label for="telepon">No telepon</label>
                            <input
                                type="text"
                                class="form-control"
                                id="telepon"
                                maxlength="15"
                                name="telepon"
                                placeholder="Nomor telepon"
                                v-model="telepon"
                            />
                        </div>
                        <div class="form-group">
                            <label for="kerja">kerja</label>
                            <input
                                type="date"
                                class="form-control"
                                id="kerja"
                                name="kerja"
                                v-model="kerja"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            data-dismiss="modal"
                            aria-label="Close"
                            type="submit"
                            @click.prevent="submit('karyawan')"
                            class="btn btn-primary close"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection