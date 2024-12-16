@extends('layouts.user')

@section('css')
   <style>
       body {
           background-image: url('{{ asset('images/background_home2.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;
           background-attachment: fixed;
       }

       .overlay {
           position: absolute;
           top: 0;
           right: 0;
           bottom: 0;
           left: 0;
           background-color: rgba(0, 0, 0, 0.3);
           z-index: 0;
       }

       /* Gallery styles */
       .gallery-section {
           padding: 6rem 2rem;
           background: rgba(255, 255, 255, 0.9);
           margin-top: 2rem;
       }

       .gallery-grid {
           display: grid;
           grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
           gap: 1.5rem;
           max-width: 1200px;
           margin: 0 auto;
       }

       .gallery-item {
           position: relative;
           border-radius: 0.5rem;
           overflow: hidden;
           aspect-ratio: 1;
           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
       }

       .gallery-image {
           width: 100%;
           height: 100%;
           object-fit: cover;
           transition: transform 0.3s ease;
       }

       .gallery-overlay {
           position: absolute;
           inset: 0;
           background: rgba(0, 0, 0, 0.5);
           display: flex;
           flex-direction: column;
           justify-content: flex-end;
           padding: 1rem;
           opacity: 0;
           transition: opacity 0.3s ease;
       }

       .gallery-item:hover .gallery-image {
           transform: scale(1.1);
       }

       .gallery-item:hover .gallery-overlay {
           opacity: 1;
       }

       .gallery-title {
           color: white;
           font-size: 1.25rem;
           font-weight: 600;
           margin: 0;
       }
   </style>
@endsection

@section('content')
   {{-- Hero Section --}}
   <main class="flex-grow container mx-auto px-6 flex flex-col justify-center items-center text-center relative min-h-screen">
       <div class="overlay"></div>
       <div class="relative z-10">
           <h2 class="text-white text-5xl font-bold mb-6">MASA DEPAN KAMI BERADA<br>DI TANGAN-MU</h2>
           <a href="{{ route('user.donate') }}"
               class="bg-white text-gray-800 font-semibold py-2 px-6 rounded-full hover:bg-gray-200 transition duration-300">
               Mulai Berdonasi Dari Sini!
           </a>
       </div>
   </main>

   {{-- Gallery Section --}}
   <section class="gallery-section">
       <h2 class="text-4xl font-bold text-center mb-12">Galeri Kegiatan</h2>
       
       <div class="gallery-grid">
           {{-- Drama --}}
           <div class="gallery-item">
               <img src="{{ asset('images/drama.png') }}" 
                    alt="Drama Performance" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Drama Performance</h3>
               </div>
           </div>

           {{-- Makan --}}
           <div class="gallery-item">
               <img src="{{ asset('images/makan.png') }}" 
                    alt="Cooking Activity" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Cooking Activity</h3>
               </div>
           </div>

           {{-- Zoo --}}
           <div class="gallery-item">
               <img src="{{ asset('images/zoo.png') }}" 
                    alt="Zoo Visit" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Zoo Visit</h3>
               </div>
           </div>

           {{-- Makan2 --}}
           <div class="gallery-item">
               <img src="{{ asset('images/makan2.png') }}" 
                    alt="Gathering" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Gathering</h3>
               </div>
           </div>

           {{-- Natal --}}
           <div class="gallery-item">
               <img src="{{ asset('images/natal.png') }}" 
                    alt="Christmas Event" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Christmas Event</h3>
               </div>
           </div>

           {{-- Paskah --}}
           <div class="gallery-item">
               <img src="{{ asset('images/paskah.png') }}" 
                    alt="Easter Event" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Easter Celebration</h3>
               </div>
           </div>

           {{-- Tas --}}
           <div class="gallery-item">
               <img src="{{ asset('images/tas.png') }}" 
                    alt="School Bag Distribution" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">School Bag Distribution</h3>
               </div>
           </div>

           {{-- Mewarnai --}}
           <div class="gallery-item">
               <img src="{{ asset('images/mewarnai.png') }}" 
                    alt="Coloring Activity" 
                    class="gallery-image">
               <div class="gallery-overlay">
                   <h3 class="gallery-title">Coloring Activity</h3>
               </div>
           </div>
       </div>
   </section>
@endsection