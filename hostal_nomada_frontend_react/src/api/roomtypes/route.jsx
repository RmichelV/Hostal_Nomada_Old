"use server"
export async function GET(request) {
    const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/roomtypes`);  
    const data = await res.json();

    // Verifica la estructura del JSON
    console.log('Response from Laravel:', data);

    return new Response(JSON.stringify(data), {  // Asegúrate de que envías el arreglo completo
      headers: { 'Content-Type': 'application/json' },
    });
}
