import { serve } from "https://deno.land/std@0.117.0/http/server_legacy.ts";

    console.log("http://localhost:8000/");

    const anzahl: number[] = [932965, 1246136 , 297446, 210009, 42434, 
                        122871, 445589, 85065, 404962, 1274675, 257311, 
                        68236, 591502, 194507, 104875, 253023];
                        
    const max: number = Math.max(...anzahl);
    const min: number = Math.min(...anzahl);
    const sum: number = anzahl.reduce(myFunction)
    function myFunction(total: number, value: number) {
        return total + value;
    }
    const average: number = sum/anzahl.length;

    const server = serve({ port: 8000 });

    console.log("http://localhost:8000/");
    
    for await (const req of server) {
        req.respond({ body: "Die kleinste Anzahl von Covid Infektionen ist: "+ min + "\n"+
                            "Die groesste Anzahl von Covid Infektionen ist: "+ max + "\n"+
                            "Die durchnitlische Anzahl von Covid Infektionen ist: "+ average + "\n"+
                            "Die gesamte Anzahl von Covid Infektionen ist: "+ sum })
    };