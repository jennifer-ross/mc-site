import 'alpine-magic-helpers/dist/component'
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm'

import Tooltip from '@ryangjchandler/alpine-tooltip'
import { Observer } from './intersect.js'

Alpine.plugin(Tooltip)

Livewire.start()
Observer.start()

import '@/utils.js'
