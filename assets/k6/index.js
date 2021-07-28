import http from 'k6/http';
import { sleep } from 'k6';

export const options = {
    duration: '1m',
    vus: 50,
    thresholds: {
        http_req_duration: ['p(95)<1000'],
    },
};

export default function () {
    const res = http.get('https://localhost:8000/custom');
    sleep(1);
}
