import Login from '../components/auth/Login'
import Department from '../components/department/Department'
import Reception from '../components/reception/Reception'
import Queue from '../components/reception/Queue'
import Report from '../components/department/Report'

import CurrentQueue from '../components/department/CurrentQueue'
import Referral from '../components/department/Referral'
import Notes from '../components/department/Notes'
import NewPatient from '../components/reception/NewPatient'

export const routes = [{
        path: '/reception',
        component: Reception,
        children: [{
                path: 'new',
                component: NewPatient
            }, {
                path: 'queue',
                component: Queue
            }

        ]
    },
    {
        path: '/:department',
        component: Department,
        children: [{
            name: 'depQueue',
            path: 'queue',
            component: CurrentQueue
        }, {
            name: "notes",
            path: 'notes/:visitId',
            component: Notes
        }, {
            name: "DepReferral",
            path: 'refer/:visitId',
            component: Referral
        }, {
            path: '/reports',
            component: Report,
            name: 'viewReports'

        }]
    }, {
        path: '*',
        redirect: {
            name: 'depQueue'
        }
    }


]
